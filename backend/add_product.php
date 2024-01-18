<?php

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

require('db_connect.php');

$request_body = file_get_contents('php://input');

$data = json_decode($request_body, true);
// var_dump($data);

// Debugging - output received data
file_put_contents('debug.txt', print_r($data, true));

if ($data !== null) {

    $type = isset($data['type']) ? $data['type'] : null;
    $size = isset($data['size']) ? $data['size'] : null;
    $weight = isset($data['weight']) ? $data['weight'] : null;
    $sku = isset($data['sku']) ? $data['sku'] : null;
    $dimensions = isset($data['dimensions']) ? $data['dimensions'] : null;
    $height = isset($dimensions['height']) ? $dimensions['height'] : null;
    $width = isset($dimensions['width']) ? $dimensions['width'] : null;
    $length = isset($dimensions['length']) ? $dimensions['length'] : null;
    $name = isset($data['name']) ? $data['name'] : null;
    $price = isset($data['price']) ? $data['price'] : null;

    $sql = "INSERT INTO products (sku, name, price, type, size, weight, dimensions)
            VALUES ('$sku', '$name', '$price', '$type', '$size', '$weight', '$dimensions')";
    // var_dump($sql);

$conn = new Operations();
var_dump($conn);

$db = $conn->dbConnection();
var_dump($db);
$stmt = $db->prepare($sql);


if ($stmt->execute()) {
    $response = array('success' => true, 'message' => 'Product added successfully');
} else {
    $errorInfo = $db->errorInfo();
    $error = $errorInfo[2];
    $response = array('success' => false, 'message' => 'Error adding product: ' . $error);
}

$db = null; // Close the connection
} else {
$response = array('success' => false, 'message' => 'Invalid data received');
}


echo json_encode($response);

?>