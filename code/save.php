<?php

// ---- DATABASE SETTINGS ----
$host = "localhost";
$dbname = "important";
$user = "root";        // vaihda jos ei ole root
$pass = "";            // lisää salasana jos on

try {
    // connect to database
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // check if all fields exist
    $required = ["country", "first", "last", "address", "postal", "city", "phone"];
    foreach ($required as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === "") {
            throw new Exception("Kenttä puuttuu: $field");
        }
    }

    // prepare SQL
    $stmt = $pdo->prepare("
        INSERT INTO orders 
            (country, first_name, last_name, address, postal, city, phone)
        VALUES
            (:country, :first_name, :last_name, :address, :postal, :city, :phone)
    ");

    // execute insert
    $stmt->execute([
        ":country"    => $_POST["country"],
        ":first_name" => $_POST["first"],
        ":last_name"  => $_POST["last"],
        ":address"    => $_POST["address"],
        ":postal"     => $_POST["postal"],
        ":city"       => $_POST["city"],
        ":phone"      => $_POST["phone"]
    ]);

    echo "<h2 style='font-family:Arial; color:green; text-align:center; margin-top:50px;'>
            Kiitos! Tilauksesi on vastaanotettu.
          </h2>";
    echo "<p style='text-align:center;'>Voit sulkea tämän sivun.</p>";

} catch (Exception $e) {
    echo "<h2 style='color:red;'>Virhe:</h2>";
    echo $e->getMessage();
}
?>