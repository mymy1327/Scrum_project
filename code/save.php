<?php
// ---- DATABASE SETTINGS ----
$host = "localhost";
$dbname = "important";

$user = "root";
$pass = "";

try {
    // Connect to database
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // Check if all fields exist
    $required = ["country", "first", "last", "address", "postal", "city", "phone", "products"];
    foreach ($required as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === "") {
            throw new Exception("No field: $field");
        }
    }

    // Preparing SQL
    $stmt = $pdo->prepare("
        INSERT INTO orders 
            (country, first_name, last_name, address, postal, city, phone, products)
        VALUES
            (:country, :first_name, :last_name, :address, :postal, :city, :phone, :products)
    ");

    // Running SQL, inserting information
    $stmt->execute([
        ":country"    => $_POST["country"],
        ":first_name" => $_POST["first"],
        ":last_name"  => $_POST["last"],
        ":address"    => $_POST["address"],
        ":postal"     => $_POST["postal"],
        ":city"       => $_POST["city"],
        ":phone"      => $_POST["phone"],
        ":products" => $_POST["products"]
    ]);

    echo "<h2 style='font-family:Arial; color:green; text-align:center; margin-top:50px;'>
            Thank you! Your order has been received.
          </h2>";

} catch (Exception $e) {
    echo "<h2 style='color:red;'>Error:</h2>";
    echo $e->getMessage();
}
?>