<?php
require_once 'core/Controller.php';
require_once __DIR__ . "/../Models/Tarifa.php";

class TarifaController extends Controller {
    protected $modelo;

    public function __construct() {
        $this->modelo = new Tarifa();
    }

    public function index() {
        $tarifas = $this->modelo->listar();
        
        $data = ["title" => "Lista de Tarifas", "tarifas" => $tarifas];
        
        // Chama a visualização passando os dados das tarifas
        $this->view('tarifas', $data);
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["categoria_id"])) {
            session_start(); // Inicia a sessão para armazenar mensagens

            // Sanitização dos dados de entrada
            $categoriaId = intval($_POST["categoria_id"]);
            $premioRcLegal = htmlspecialchars($_POST["premio_rc_legal"], ENT_QUOTES, "UTF-8");
            $premioComercialRc = htmlspecialchars($_POST["premio_comercial_rc"], ENT_QUOTES, "UTF-8");
            $indiceDesconto = htmlspecialchars($_POST["indice_desconto"], ENT_QUOTES, "UTF-8");
            $premioPoc = htmlspecialchars($_POST["premio_poc"], ENT_QUOTES, "UTF-8");
            $premioQiv = htmlspecialchars($_POST["premio_qiv"], ENT_QUOTES, "UTF-8");
            $taxaDanosProprios = htmlspecialchars($_POST["taxa_danos_proprios"], ENT_QUOTES, "UTF-8");
            $taxaComercial = htmlspecialchars($_POST["taxa_comercial"], ENT_QUOTES, "UTF-8");
            $dataVigencia = htmlspecialchars($_POST["data_vigencia"], ENT_QUOTES, "UTF-8");

            // Verifica se os campos obrigatórios não estão vazios
            if (!empty($categoriaId)) {
                // Chama a função de cadastro no Model
                $resultado = $this->modelo->cadastrar($categoriaId, $premioRcLegal, $premioComercialRc, 
                                                      $indiceDesconto, $premioPoc, $premioQiv, 
                                                      $taxaDanosProprios, $taxaComercial, $dataVigencia);

                if ($resultado["success"]) {
                    echo json_encode(["success" => true, "message" => "Tarifa cadastrada com sucesso!"]);
                } else {
                    echo json_encode(["success" => false, "message" => "Erro ao cadastrar tarifa: " . $resultado["error"]]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Todos os campos são obrigatórios."]);
            }
            exit;
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Requisição inválida."]);
            exit;
        }
    }

    // Método para editar uma tarifa
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
            session_start();

            // Log dos dados recebidos
            error_log("Dados recebidos para atualização: " . print_r($_POST, true));

            // Sanitização dos dados de entrada
            $id = intval($_POST["id"]);
            $premioRcLegal = htmlspecialchars($_POST["premio_rc_legal"], ENT_QUOTES, "UTF-8");
            $premioComercialRc = htmlspecialchars($_POST["premio_comercial_rc"], ENT_QUOTES, "UTF-8");
            $indiceDesconto = htmlspecialchars($_POST["indice_desconto"], ENT_QUOTES, "UTF-8");
            $premioPoc = htmlspecialchars($_POST["premio_poc"], ENT_QUOTES, "UTF-8");
            $premioQiv = htmlspecialchars($_POST["premio_qiv"], ENT_QUOTES, "UTF-8");
            $taxaDanosProprios = htmlspecialchars($_POST["taxa_danos_proprios"], ENT_QUOTES, "UTF-8");
            $taxaComercial = htmlspecialchars($_POST["taxa_comercial"], ENT_QUOTES, "UTF-8");
            $dataVigencia = htmlspecialchars($_POST["data_vigencia"], ENT_QUOTES, "UTF-8");

            // Log dos dados sanitizados
            error_log("Dados sanitizados: " . print_r([
                "id" => $id,
                "premio_rc_legal" => $premioRcLegal,
                "premio_comercial_rc" => $premioComercialRc,
                "indice_desconto" => $indiceDesconto,
                "premio_poc" => $premioPoc,
                "premio_qiv" => $premioQiv,
                "taxa_danos_proprios" => $taxaDanosProprios,
                "taxa_comercial" => $taxaComercial,
                "data_vigencia" => $dataVigencia
            ], true));

            // Chama a função de atualização no Model
            $resultado = $this->modelo->atualizar($id, $premioRcLegal, $premioComercialRc, $indiceDesconto, $premioPoc, $premioQiv, $taxaDanosProprios, $taxaComercial, $dataVigencia);

            if ($resultado["success"]) {
                echo json_encode(["success" => true, "message" => "Tarifa atualizada com sucesso!"]);
            } else {
                error_log("Erro ao atualizar tarifa: " . $resultado["error"]); // Log do erro
                echo json_encode(["success" => false, "message" => "Erro ao atualizar tarifa: " . $resultado["error"]]);
            }
            exit;
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Requisição inválida."]);
            exit;
        }
    }

    // Método para excluir uma tarifa
    public function delete($id) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();

            // Log do ID recebido
            error_log("ID recebido para exclusão: " . $id);

            // Chama a função de exclusão no Model
            $resultado = $this->modelo->excluir($id);

            if ($resultado["success"]) {
                echo json_encode(["success" => true, "message" => "Tarifa excluída com sucesso!"]);
            } else {
                error_log("Erro ao excluir tarifa: " . $resultado["error"]);
                echo json_encode(["success" => false, "message" => "Erro ao excluir tarifa: " . $resultado["error"]]);
            }
            exit;
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Requisição inválida."]);
            exit;
        }
    }
}
?>
