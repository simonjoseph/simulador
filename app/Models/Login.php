<?php
require_once __DIR__ . "/../../config/database.php";

class Login {
    private $conn;
    private $table_name = "users";

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

    public function verificarCredenciais($username, $password) {
        $query = "SELECT id, username, email, status FROM " . $this->table_name . " 
                  WHERE username = :username AND password = :password AND status = 1";
        $stmt = $this->conn->prepare($query);

        // Bind dos parâmetros
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        // Retorna o usuário se encontrado
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
