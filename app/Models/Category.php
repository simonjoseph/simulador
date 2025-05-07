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

    public function buscarTarifasPorCategoria($categoriaId)
    {
        try {
            $query = "SELECT * FROM tarifas WHERE categoria_id = :categoria_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':categoria_id', $categoriaId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar tarifas: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            $query = "SELECT nome FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar categoria: " . $e->getMessage());
            return null;
        }
    }

    public function atualizarCategoria($id, $nome) {
        try {
            $query = "UPDATE " . $this->table_name . " SET nome = :nome WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ["success" => true];
            } else {
                return ["success" => false, "error" => "Erro ao executar a query."];
            }
        } catch (PDOException $e) {
            error_log("Erro ao atualizar categoria: " . $e->getMessage());
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    public function excluirCategoria($id) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ["success" => true];
            } else {
                return ["success" => false, "error" => "Erro ao executar a query."];
            }
        } catch (PDOException $e) {
            error_log("Erro ao excluir categoria: " . $e->getMessage());
            return ["success" => false, "error" => $e->getMessage()];
        }
    }
}
?>
