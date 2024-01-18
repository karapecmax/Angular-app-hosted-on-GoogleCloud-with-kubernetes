<?php
require 'db_connect.php';

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

if (isset($data) && is_array($data)) {
    $conn = new Operations();
    $db = $conn->dbConnection();

    foreach ($data as $id) {
        $id = (int)$id; 

        $sql = "DELETE FROM products 
                WHERE id = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
        } else {
            $response = array('success' => false, 'message' => 'Error deleting product with ID ' . $id);
            echo json_encode($response);
            exit;
        }
    }

    $response = array('success' => true, 'message' => 'Products deleted successfully');
    echo json_encode($response);
} else {
    $response = array('success' => false, 'message' => 'Invalid data received');
    echo json_encode($response);
}
?>