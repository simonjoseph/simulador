<?php
require_once __DIR__ . "/../../config/database.php";

class Simulacao
{
    private $conn;
    private $table_name = "simuladores";

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

    public function cadastrar($cotacao, $nome, $email, $nif, $contato, $endereco, $matricula, $marca, $modelo, $cilindrada, $ano_fabrico, $data_inicio, $id_categoria, $premio_rc_legal, $premio_comercial_rc)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " (cotacao, nome, email, nif, contato, endereco, matricula, marca, modelo, cilindrada, ano_fabrico, data_inicio, id_categoria, premio_rc_legal, premio_comercial_rc) 
                      VALUES (:cotacao, :nome, :email, :nif, :contato, :endereco, :matricula, :marca, :modelo, :cilindrada, :ano_fabrico, :data_inicio, :id_categoria, :premio_rc_legal, :premio_comercial_rc)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":cotacao", $cotacao, PDO::PARAM_STR);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":nif", $nif, PDO::PARAM_STR);
            $stmt->bindParam(":contato", $contato, PDO::PARAM_STR);
            $stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $stmt->bindParam(":matricula", $matricula, PDO::PARAM_STR);
            $stmt->bindParam(":marca", $marca, PDO::PARAM_STR);
            $stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);
            $stmt->bindParam(":cilindrada", $cilindrada, PDO::PARAM_STR);
            $stmt->bindParam(":ano_fabrico", $ano_fabrico, PDO::PARAM_STR);
            $stmt->bindParam(":data_inicio", $data_inicio, PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_STR);
            $stmt->bindParam(":premio_rc_legal", $premio_rc_legal, PDO::PARAM_STR);
            $stmt->bindParam(":premio_comercial_rc", $premio_comercial_rc, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function atualizar($id, $nome, $email, $nif, $contato, $endereco, $matricula, $marca, $modelo, $cilindrada, $ano_fabrico, $data_inicio, $id_categoria, $premio_rc_legal, $premio_comercial_rc)
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

    public function cotacaoExiste($cotacao)
    {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE cotacao = :cotacao";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cotacao", $cotacao, PDO::PARAM_STR);
        $stmt->execute();

        // Obtém o número de registros encontrados
        $count = $stmt->fetchColumn();

        return $count > 0; // Retorna true se a cotação já existir
    }

    public function buscarPorCotacao($cotacao)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE cotacao = :cotacao LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cotacao", $cotacao, PDO::PARAM_STR);
        $stmt->execute();

        // Retorna o registro encontrado (ou false se não encontrado)
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Adicione este método à classe Simulacao
    public function obterUltimaCotacao()
    {
        try {
            $sql = "SELECT cotacao FROM " . $this->table_name . " ORDER BY id DESC LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return $resultado['cotacao'];
            }

            return null;
        } catch (PDOException $e) {
            error_log("Erro ao obter última cotação: " . $e->getMessage());
            return null;
        }
    }
}
