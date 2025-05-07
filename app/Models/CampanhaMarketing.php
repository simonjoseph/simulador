<?php
require_once __DIR__ . "/../../config/database.php";

class CampanhaMarketing
{
    private $conn;
    private $table_name = "campanha_marketing";

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

    public function buscarPorId($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $dataInicio, $dataFim, $orcamento)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                      (nome, data_inicio, data_fim, percentagem) 
                      VALUES 
                      (:nome, :data_inicio, :data_fim, :percentagem)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            // $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->bindParam(":data_inicio", $dataInicio, PDO::PARAM_STR);
            $stmt->bindParam(":data_fim", $dataFim, PDO::PARAM_STR);
            $stmt->bindParam(":percentagem", $orcamento, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ["success" => true];
            } else {
                return ["success" => false, "error" => "Erro ao executar a query."];
            }
        } catch (PDOException $e) {
            return ["success" => false, "error" => "Erro no banco de dados: " . $e->getMessage()];
        }
    }

    public function atualizar($id, $nome, $dataInicio, $dataFim, $percentagem, $tipoSeguro)
    {
        try {
            $query = "UPDATE " . $this->table_name . " 
                      SET nome = :nome, data_inicio = :data_inicio, data_fim = :data_fim, 
                          percentagem = :percentagem, tipo_seguro = :tipo_seguro 
                      WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":data_inicio", $dataInicio, PDO::PARAM_STR);
            $stmt->bindParam(":data_fim", $dataFim, PDO::PARAM_STR);
            $stmt->bindParam(":percentagem", $percentagem, PDO::PARAM_STR);
            $stmt->bindParam(":tipo_seguro", $tipoSeguro, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ["success" => true];
            } else {
                return ["success" => false, "error" => "Erro ao executar a query."];
            }
        } catch (PDOException $e) {
            error_log("Erro ao atualizar campanha: " . $e->getMessage());
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    public function excluir($id)
    {
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
            return ["success" => false, "error" => "Erro no banco de dados: " . $e->getMessage()];
        }
    }
}
?>
