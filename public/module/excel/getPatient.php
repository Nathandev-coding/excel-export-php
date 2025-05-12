<?php
// Include the database connection file


class Patient{
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
     public function getAllPatients(){
        $query = "SELECT * FROM patients ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultat = $stmt->get_result();
        return $resultat->fetch_all(MYSQLI_ASSOC);
    }
}
?>