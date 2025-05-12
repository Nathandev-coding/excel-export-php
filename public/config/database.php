<?php
class Database {
    private $conn;
    private $host = "localhost";
    private $db_name = "gestion_hopital";
    private $username = "root";
    private $password = "";

    public function __construct() {
        // Aucun paramètre n'est nécessaire ici
    }

    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        else {
            echo "Connected successfully";
        }

        $this->conn->set_charset("utf8mb4"); // Bonnes pratiques
        return $this->conn;
    }
}
?>
