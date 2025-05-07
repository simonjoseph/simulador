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

    public function atualizar($id, $premioRcLegal, $premioComercialRc, $indiceDesconto, $premioPoc, $premioQiv, $taxaDanosProprios, $taxaComercial, $dataVigencia) {
        try {
            $query = "UPDATE tarifas SET 
                        premio_rc_legal = :premio_rc_legal,
                        premio_comercial_rc = :premio_comercial_rc,
                        indice_desconto = :indice_desconto,
                        premio_poc = :premio_poc,
                        premio_qiv = :premio_qiv,
                        taxa_danos_proprios = :taxa_danos_proprios,
                        taxa_comercial = :taxa_comercial,
                        data_vigencia = :data_vigencia
                      WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":premio_rc_legal", $premioRcLegal);
            $stmt->bindParam(":premio_comercial_rc", $premioComercialRc);
            $stmt->bindParam(":indice_desconto", $indiceDesconto);
            $stmt->bindParam(":premio_poc", $premioPoc);
            $stmt->bindParam(":premio_qiv", $premioQiv);
            $stmt->bindParam(":taxa_danos_proprios", $taxaDanosProprios);
            $stmt->bindParam(":taxa_comercial", $taxaComercial);
            $stmt->bindParam(":data_vigencia", $dataVigencia);

            if ($stmt->execute()) {
                return ["success" => true];
            } else {
                return ["success" => false, "error" => "Erro ao executar a query."];
            }
        } catch (PDOException $e) {
            error_log("Erro ao atualizar tarifa: " . $e->getMessage()); // Adiciona o erro no log
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    public function excluir($id) {
        try {
            $query = "DELETE FROM tarifas WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ["success" => true];
            } else {
                return ["success" => false, "error" => "Erro ao executar a query."];
            }
        } catch (PDOException $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }
}
