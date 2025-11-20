<?php
session_start();
header('Content-Type: application/json');

$servername = "localhost";
$username_db = "root"; 
$password_db = ""; 
$dbname = "user_controller"; 

$response = ['success' => false, 'message' => ''];

// check login status
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION['user_id'])) {
    http_response_code(401); 
    $response['message'] = 'Unauthorized.';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];

// take input data
$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['product_name'])) {
    http_response_code(400); // Bad Request
    $response['message'] = 'product_name is invalid.';
    echo json_encode($response);
    exit;
}

$productName = $data['product_name'];

try {
    // connect to DB
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // delete query
    $sql = "DELETE FROM carts WHERE user_id = :user_id AND product_name = :product_name";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':product_name' => $productName
    ]);

    // *5. Phản hồi
    if ($stmt->rowCount() > 0) {
        $response['success'] = true;
        $response['message'] = 'Product removed successfully.';
    } else {
        $response['message'] = 'Cannot find "' . htmlspecialchars($productName) . '" in your cart.';
    }

} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    $response['message'] = "DB error " . $e->getMessage();
} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    $response['message'] = "Server error " . $e->getMessage();
}

echo json_encode($response);
exit;