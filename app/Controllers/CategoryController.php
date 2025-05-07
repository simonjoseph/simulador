<?php
require_once 'core/Controller.php';
require_once __DIR__ . "/../Models/Category.php";

class CategoryController extends Controller {
    protected $modelo; // Defina a propriedade como protegida

    public function __construct() {
        $this->modelo = new Category();
    }

    public function index() {
        $categorias = $this->modelo->listar();
        
        $data = ["title" => "Categoria do Simulador", "categorias" => $categorias];
        // print_r($categorias);
        
        // exit();
        
        // Chama a visualização passando os dados e categorias
        $this->view('category', $data);
    }
    
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
            
            $categoryName = htmlspecialchars($_POST["nome"], ENT_QUOTES, "UTF-8");
            
            if (!empty($categoryName)) {

                $this->modelo->cadastrar($categoryName);

                header('Location: /simulador/category');
                exit;
            } else {
                
                $data = ["title" => "Categoria do Simulador", "error" => "Nome da categoria não pode estar vazio"];
                // $this->view('category', $data);
                header('Location: /simulador/category');
            }
        } else {
            
            header('Location: /category');
            exit;
        }
    }

    public function ver($id)
    {
        // Verifica se o ID é válido
        if (!is_numeric($id)) {
            header('Location: /simulador/category');
            exit;
        }

        // Busca as tarifas relacionadas à categoria
        $tarifas = $this->modelo->buscarTarifasPorCategoria($id);
        $categoria = $this->modelo->buscarPorId($id);

        // Renderiza a página de visualização
        $data = [
            "title" => "Tarifas da Categoria",
            "tarifas" => $tarifas,
            "categoriaId" => $id,
            "categoriaNome" => $categoria["nome"]
        ];

        $this->view('tarifa_view', $data);
    }
    
    // Método para editar uma tarifa
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"]) && isset($_POST["nome"])) {
            session_start();

            // Log dos dados recebidos
            error_log("Dados recebidos para atualização: " . print_r($_POST, true));

            // Sanitização dos dados de entrada
            $id = intval($_POST["id"]);
            $nome = htmlspecialchars($_POST["nome"], ENT_QUOTES, "UTF-8");

            if (!empty($nome)) {
                // Chama a função de atualização no Model
                $resultado = $this->modelo->atualizarCategoria($id, $nome);

                if ($resultado["success"]) {
                    echo json_encode(["success" => true, "message" => "Categoria atualizada com sucesso!"]);
                } else {
                    error_log("Erro ao atualizar categoria: " . $resultado["error"]); // Log do erro
                    echo json_encode(["success" => false, "message" => "Erro ao atualizar categoria: " . $resultado["error"]]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "O nome da categoria não pode estar vazio."]);
            }
            exit;
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Requisição inválida."]);
            exit;
        }
    }

    // Método para excluir uma categoria
    public function delete($id) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();

            if (is_numeric($id)) {
                $resultado = $this->modelo->excluirCategoria($id);

                if ($resultado["success"]) {
                    echo json_encode(["success" => true, "message" => "Categoria excluída com sucesso!"]);
                } else {
                    echo json_encode(["success" => false, "message" => "Erro ao excluir categoria: " . $resultado["error"]]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "ID inválido."]);
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
