<?php
session_start(); 

header('Content-Type: application/json');

$response = [
    'loggedIn' => false
];

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $response['loggedIn'] = true;
}

echo json_encode($response);
exit;
?>