<?php

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

require('db_connect.php');

$conn = new Operations();
$db = $conn->dbConnection();

if ($db) {
    $sql = "SELECT * FROM products";
    $result = $db->query($sql);

    if ($result) {
        $products = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }

        $response = array('success' => true, 'data' => $products);
    } else {
        $errorInfo = $db->errorInfo();
        $error = $errorInfo[2];
        $response = array('success' => false, 'message' => 'Error retrieving products: ' . $error);
    }

    $db = null; // Close the connection
} else {
    $response = array('success' => false, 'message' => 'Database connection error');
}

echo json_encode($response);

?>