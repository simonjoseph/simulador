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

    public function verificar_existencia($nome) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE nome = :nome LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['id'];
        } else {
            return null;
        }
    }
    
}
?>
