<?php
session_start();
header('Content-Type: application/json');
 
$servername = "localhost";
$username_db = "root"; 
$password_db = ""; 
$dbname = "user_controller";

// check user login status
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['success' => false, 'message' => 'Require login to add product.']);
    exit;
}

$user_id = $_SESSION['user_id']; 
$username = $_SESSION['username']; 
$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['name']) || empty($data['price']) || empty($data['image'])) {
    echo json_encode(['success' => false, 'message' => 'product data is invalid.']);
    exit;
}

$productName = $data['name'];
$productPrice = $data['price'];
$productImage = $data['image'];
$quantity = 1;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // find if product already in cart
    $stmt = $conn->prepare("SELECT id FROM carts WHERE user_id = :user_id AND product_name = :name");
    $stmt->execute(['user_id' => $user_id, 'name' => $productName]);
    $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingItem) {
        // update quantity
        $updateStmt = $conn->prepare("UPDATE carts SET quantity = quantity + 1 WHERE id = :id");
        $updateStmt->execute(['id' => $existingItem['id']]);
    } else {
        // add new item to cart
        $insertStmt = $conn->prepare("INSERT INTO carts (user_id, product_image, product_name, product_price, quantity) 
                                     VALUES (:user_id, :image, :name, :price, :quantity)");
        $insertStmt->execute([
            'user_id' => $user_id, 
            'image' => $productImage,
            'name' => $productName, 
            'price' => $productPrice, 
            'quantity' => $quantity
        ]);
    }

    echo json_encode(['success' => true, 'message' => 'current product added to cart.']);

} catch (PDOException $e) {
    error_log("Cart error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'error adding to cart.']);
}
?>