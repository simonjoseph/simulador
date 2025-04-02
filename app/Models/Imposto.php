<?php
require_once __DIR__ . "/../../config/database.php";

class Imposto
{
    private $conn;
    private $table_name = "imposto";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function listar()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarImpostos()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC LIMIT 1"; // Supondo que 'id' seja a coluna que determina a ordem
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Usar fetch ao invés de fetchAll
    }

    public function buscarPorId($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($cambio, $fga, $iva, $desconto, $cambio_geral)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " (cambio, fga, iva, desconto, cambio_geral) 
                      VALUES (:cambio, :fga, :iva, :desconto, :cambio_geral)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":cambio", $cambio, PDO::PARAM_STR);
            $stmt->bindParam(":fga", $fga, PDO::PARAM_STR);
            $stmt->bindParam(":iva", $iva, PDO::PARAM_STR);
            $stmt->bindParam(":desconto", $desconto, PDO::PARAM_STR);
            $stmt->bindParam(":cambio_geral", $cambio_geral, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function atualizar($id, $cambio, $fga, $iva, $desconto, $cambio_geral)
    {
        try {
            $query = "UPDATE " . $this->table_name . " SET cambio = :cambio, fga = :fga, 
                      iva = :iva, desconto = :desconto, cambio_geral = :cambio_geral WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":cambio", $cambio, PDO::PARAM_STR);
            $stmt->bindParam(":fga", $fga, PDO::PARAM_STR);
            $stmt->bindParam(":iva", $iva, PDO::PARAM_STR);
            $stmt->bindParam(":desconto", $desconto, PDO::PARAM_STR);
            $stmt->bindParam(":cambio_geral", $cambio_geral, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function excluir($id)
    {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
