<?php

$host = "localhost";
$dbname = "important";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("
        INSERT INTO orders
        (country, first_name, last_name, address, postal, city, phone)
        VALUES
        (:country, :first, :last, :address, :postal, :city, :phone)
    ");

    $stmt->execute([
        ":country" => $_POST["country"],
        ":first"   => $_POST["first"],
        ":last"    => $_POST["last"],
        ":address" => $_POST["address"],
        ":postal"  => $_POST["postal"],
        ":city"    => $_POST["city"],
        ":phone"   => $_POST["phone"],
    ]);

    echo "<h2 style='font-family:Arial; color:green; text-align:center; margin-top:50px;'>
            Kiitos! Tilauksesi on vastaanotettu.
          </h2>";
    echo "<p style='text-align:center;'>Voit sulkea tämän sivun.</p>";

}
?>
