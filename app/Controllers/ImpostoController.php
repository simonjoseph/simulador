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
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cambio"])) {
            session_start();
            $cambio = htmlspecialchars($_POST["cambio"], ENT_QUOTES, "UTF-8");
            $fga = htmlspecialchars($_POST["fga"], ENT_QUOTES, "UTF-8");
            $iva = htmlspecialchars($_POST["iva"], ENT_QUOTES, "UTF-8");
            $desconto = htmlspecialchars($_POST["desconto"], ENT_QUOTES, "UTF-8");
            $cambio_geral = htmlspecialchars($_POST["cambio_geral"], ENT_QUOTES, "UTF-8");

            if (!empty($cambio)) {
                $resultado = $this->modelo->cadastrar($cambio, $fga, $iva, $desconto, $cambio_geral);

                $_SESSION[$resultado ? "success" : "error"] = 
                    $resultado ? "Imposto cadastrado com sucesso!" : "Erro ao cadastrar.";

                header('Location: /simulador/imposto');
                exit;
            } else {
                $_SESSION["error"] = "Todos os campos são obrigatórios.";
                header('Location: /simulador/imposto');
                exit;
            }
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
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
            session_start();
            $id = intval($_POST["id"]);
            $cambio = htmlspecialchars($_POST["cambio"], ENT_QUOTES, "UTF-8");
            $fga = htmlspecialchars($_POST["fga"], ENT_QUOTES, "UTF-8");
            $iva = htmlspecialchars($_POST["iva"], ENT_QUOTES, "UTF-8");
            $desconto = htmlspecialchars($_POST["desconto"], ENT_QUOTES, "UTF-8");
            $cambio_geral = htmlspecialchars($_POST["cambio_geral"], ENT_QUOTES, "UTF-8");

            if (!empty($cambio) && !empty($fga) && !empty($iva) && !empty($desconto) && !empty($cambio_geral)) {
                $resultado = $this->modelo->atualizar($id, $cambio, $fga, $iva, $desconto, $cambio_geral);

                $_SESSION[$resultado ? "success" : "error"] = 
                    $resultado ? "Imposto atualizado com sucesso!" : "Erro ao atualizar.";

                header('Location: /simulador/impostos');
                exit;
            }
        }
    }

    public function delete($id) {
        session_start();
        $resultado = $this->modelo->excluir($id);

        $_SESSION[$resultado ? "success" : "error"] = 
            $resultado ? "Imposto excluído com sucesso!" : "Erro ao excluir.";

        header('Location: /simulador/impostos');
        exit;
    }
}
