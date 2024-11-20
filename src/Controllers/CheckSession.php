<?php
session_start();
header('Content-Type: application/json');

$response = [
    'session_exists' => isset($_SESSION['isLogin']) ? true : false
];

echo json_encode($response);

?>
