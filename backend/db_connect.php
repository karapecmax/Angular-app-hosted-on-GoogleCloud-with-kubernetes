<?php

class Operations
{
    private $db_host = 'mysql-db-service'; // Docker container name
    private $db_name = 'products';
    private $db_username = 'root';
    private $db_password = '12345678';

    public function dbConnection()
    {
        try {
            $conn = new PDO('mysql:host=' . $this->db_host . ';port=3306;dbname=' . $this->db_name, $this->db_username, $this->db_password, array(PDO::ATTR_PERSISTENT => true));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection error " . $e->getMessage();
            exit;
        }
    }
}
?>