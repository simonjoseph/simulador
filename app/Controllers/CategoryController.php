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

    // public function createTarifa() {
    //     if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
            
    //         $categoryName = htmlspecialchars($_POST["nome"], ENT_QUOTES, "UTF-8");
            
    //         if (!empty($categoryName)) {

    //             $this->modelo->cadastrar($categoryName);

    //             header('Location: /simulador/category');
    //             exit;
    //         } else {
                
    //             $data = ["title" => "Categoria do Simulador", "error" => "Nome da categoria não pode estar vazio"];
    //             // $this->view('category', $data);
    //             header('Location: /simulador/category');
    //         }
    //     } else {
            
    //         header('Location: /category');
    //         exit;
    //     }
    // }
    
}
?>
