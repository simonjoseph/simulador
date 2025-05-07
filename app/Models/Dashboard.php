<?php
require_once __DIR__ . "/../../config/database.php";

class Dashboard
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Consulta 1: Simulações por mês
    public function getSimulacoesPorMes()
    {
        try {
            $query = "
                SELECT 
                    MONTH(created_at) AS mes, 
                    COUNT(id) AS total_simulacoes 
                FROM simuladores 
                GROUP BY MONTH(created_at)
                ORDER BY MONTH(created_at) ASC
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["success" => false, "error" => "Erro no banco de dados: " . $e->getMessage()];
        }
    }

    // Consulta 2: Simulações por categoria de veículo
    public function getSimulacoesPorCategoria()
    {
        try {
            $query = "
                SELECT 
                    categorias_veiculos.nome AS categoria, 
                    COUNT(simuladores.id) AS total_simulacoes 
                FROM simuladores
                INNER JOIN categorias_veiculos 
                    ON simuladores.id_categoria = categorias_veiculos.id
                GROUP BY categorias_veiculos.nome
                ORDER BY categorias_veiculos.nome ASC
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["success" => false, "error" => "Erro no banco de dados: " . $e->getMessage()];
        }
    }

    // Consulta 3: Simulações por campanha de marketing
    public function getSimulacoesPorCampanha()
    {
        try {
            $query = "
                SELECT 
                    campanha_marketing.nome AS campanha, 
                    COUNT(simuladores.id) AS total_simulacoes 
                FROM simuladores
                INNER JOIN campanha_marketing 
                    ON simuladores.id_campanha_marketing = campanha_marketing.id
                GROUP BY campanha_marketing.nome
                ORDER BY campanha_marketing.nome ASC
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["success" => false, "error" => "Erro no banco de dados: " . $e->getMessage()];
        }
    }
}
?>