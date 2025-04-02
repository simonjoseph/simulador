<?php
require_once __DIR__ . "/../../config/database.php";

class Tarifa
{
    private $conn;
    private $table_name = "tarifas";

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

    public function listarTarifasPorCategoria()
    {
        $query = "SELECT * FROM categorias_veiculos cv JOIN tarifas t ON cv.id = t.categoria_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar(
        $categoriaId,
        $premioRcLegal,
        $premioComercialRc,
        $indiceDesconto,
        $premioPoc,
        $premioQiv,
        $taxaDanosProprios,
        $taxaComercial,
        $dataVigencia
    ) {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                  (categoria_id, premio_rc_legal, premio_comercial_rc, indice_desconto, 
                   premio_poc, premio_qiv, taxa_danos_proprios, taxa_comercial, data_vigencia) 
                  VALUES 
                  (:categoria_id, :premio_rc_legal, :premio_comercial_rc, :indice_desconto, 
                   :premio_poc, :premio_qiv, :taxa_danos_proprios, :taxa_comercial, :data_vigencia)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":categoria_id", $categoriaId, PDO::PARAM_INT);
            $stmt->bindParam(":premio_rc_legal", $premioRcLegal, PDO::PARAM_STR);
            $stmt->bindParam(":premio_comercial_rc", $premioComercialRc, PDO::PARAM_STR);
            $stmt->bindParam(":indice_desconto", $indiceDesconto, PDO::PARAM_STR);
            $stmt->bindParam(":premio_poc", $premioPoc, PDO::PARAM_STR);
            $stmt->bindParam(":premio_qiv", $premioQiv, PDO::PARAM_STR);
            $stmt->bindParam(":taxa_danos_proprios", $taxaDanosProprios, PDO::PARAM_STR);
            $stmt->bindParam(":taxa_comercial", $taxaComercial, PDO::PARAM_STR);
            $stmt->bindParam(":data_vigencia", $dataVigencia, PDO::PARAM_STR);

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
