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
                    $_SESSION["success"] = "Tarifa cadastrada com sucesso!";
                } else {
                    $_SESSION["error"] = "Erro ao cadastrar tarifa: " . $resultado["error"];
                }
    
                header('Location: /simulador/category');
                exit;
            } else {
                $_SESSION["error"] = "Todos os campos são obrigatórios.";
                header('Location: /simulador/category');
                exit;
            }
        } else {
            header('Location: /category');
            exit;
        }
    }
    
}
?>
