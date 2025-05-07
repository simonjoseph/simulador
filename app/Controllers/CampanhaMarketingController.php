<?php
require_once 'core/Controller.php';
require_once __DIR__ . "/../Models/CampanhaMarketing.php";

class CampanhaMarketingController extends Controller {
    protected $modelo;

    public function __construct() {
        $this->modelo = new CampanhaMarketing();
    }

    public function index() {
        $campanhas = $this->modelo->listar();
        $data = ["title" => "Lista de Campanhas de Marketing", "campanhas" => $campanhas];
        $this->view('campanhas_marketing', $data);
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
            session_start();
            $nome = htmlspecialchars($_POST["nome"], ENT_QUOTES, "UTF-8");
            // $descricao = htmlspecialchars($_POST["descricao"], ENT_QUOTES, "UTF-8");
            $dataInicio = htmlspecialchars($_POST["data_inicio"], ENT_QUOTES, "UTF-8");
            $dataFim = htmlspecialchars($_POST["data_fim"], ENT_QUOTES, "UTF-8");
            $orcamento = htmlspecialchars($_POST["percentagem"], ENT_QUOTES, "UTF-8");

            // if (!empty($nome) && !empty($dataInicio) && !empty($dataFim) && !empty($orcamento)) {
            if (!empty($nome)) {
                $resultado = $this->modelo->cadastrar($nome, $dataInicio, $dataFim, $orcamento);

                $_SESSION[$resultado["success"] ? "success" : "error"] = 
                    $resultado["success"] ? "Campanha cadastrada com sucesso!" : "Erro ao cadastrar: " . $resultado["error"];

                header('Location: /simulador/CampanhaMarketing');
                exit;
            } else {
                $_SESSION["error"] = "Todos os campos são obrigatórios.";
                header('Location: /simulador/CampanhaMarketing');
                exit;
            }
        }
    }

    public function edit($id) {
        $campanha = $this->modelo->buscarPorId($id);
        if (!$campanha) {
            header('Location: /simulador/campanha-marketing');
            exit;
        }
        $data = ["title" => "Editar Campanha", "campanha" => $campanha];
        $this->view('campanha_edit', $data);
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Obtenha os dados do formulário
            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $percentagem = $_POST["percentagem"];
            $dataInicio = $_POST["data_inicio"];
            $dataFim = $_POST["data_fim"];
            $tipoSeguro = $_POST["tipo_seguro"];

            // Chame o modelo para atualizar a campanha
            $resultado = $this->modelo->atualizar($id, $nome, $dataInicio, $dataFim, $percentagem, $tipoSeguro);

            // Retorne uma resposta JSON
            header('Content-Type: application/json'); // Define o cabeçalho como JSON
            if ($resultado["success"]) {
                echo json_encode(["success" => true, "message" => "Campanha atualizada com sucesso!"]);
            } else {
                echo json_encode(["success" => false, "message" => $resultado["error"]]);
            }
            exit;
        } else {
            // Método não permitido
            http_response_code(405);
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Método não permitido."]);
            exit;
        }
    }

    public function delete($id) {
        session_start();
        $resultado = $this->modelo->excluir($id);

        $_SESSION[$resultado["success"] ? "success" : "error"] = 
            $resultado["success"] ? "Campanha excluída com sucesso!" : "Erro ao excluir: " . $resultado["error"];

        header('Location: /simulador/campanha-marketing');
        exit;
    }
}
?>
