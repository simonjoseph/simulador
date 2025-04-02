<?php
require_once __DIR__ . "/../../config/database.php";

class Category {
    private $conn;
    private $table_name = "categorias_veiculos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function listar() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome) {
        $query = "INSERT INTO " . $this->table_name . " (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>
