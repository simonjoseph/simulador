<?php
require_once 'core/Controller.php';
require_once __DIR__ . '/../Models/Imposto.php';

class ImpostoController extends Controller {
    protected $modelo;

    public function __construct() {
        $this->modelo = new Imposto();
    }

    public function index() {
        $impostos = $this->modelo->listar();
        $data = ["title" => "Lista de Impostos", "impostos" => $impostos];
        $this->view('imposto', $data);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            // Obtenha os dados do formulário
            $cambio = $_POST['cambio'];
            $fga = $_POST['fga'];
            $iva = $_POST['iva'];
            $desconto = $_POST['desconto'];
            $cambioGeral = $_POST['cambio_geral'];

            // Salve os dados no banco de dados
            $resultado = $this->modelo->cadastrar($cambio, $fga, $iva, $desconto, $cambioGeral);

            if ($resultado) {
                echo json_encode(["success" => true, "message" => "Imposto cadastrado com sucesso!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao cadastrar o imposto."]);
            }
            exit;
        } else {
            http_response_code(405); // Método não permitido
            echo json_encode(["success" => false, "message" => "Método não permitido."]);
            exit;
        }
    }

    public function edit($id) {
        $imposto = $this->modelo->buscarPorId($id);
        if (!$imposto) {
            header('Location: /simulador/impostos');
            exit;
        }
        $data = ["title" => "Editar Imposto", "imposto" => $imposto];
        $this->view('imposto_edit', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            // Obtenha os dados do formulário
            $id = $_POST['id'];
            $cambio = $_POST['cambio'];
            $fga = $_POST['fga'];
            $iva = $_POST['iva'];
            $desconto = $_POST['desconto'];
            $cambioGeral = $_POST['cambio_geral'];

            // Atualize os dados no banco de dados
            $resultado = $this->modelo->atualizar($id, $cambio, $fga, $iva, $desconto, $cambioGeral);

            if ($resultado) {
                echo json_encode(["success" => true, "message" => "Imposto atualizado com sucesso!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao atualizar o imposto."]);
            }
            exit;
        } else {
            http_response_code(405); // Método não permitido
            echo json_encode(["success" => false, "message" => "Método não permitido."]);
            exit;
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $resultado = $this->modelo->excluir($id);

            if ($resultado) {
                echo json_encode(["success" => true, "message" => "Imposto excluído com sucesso!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao excluir o imposto."]);
            }
            exit;
        } else {
            http_response_code(405); // Método não permitido
            echo json_encode(["success" => false, "message" => "Método não permitido."]);
            exit;
        }
    }
    
}
