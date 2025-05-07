<?php
require_once 'core/Controller.php';
// require_once __DIR__ . "/../Models/CampanhaMarketing.php";
require_once __DIR__ . "/../Models/Simulacao.php";

class SimulacoesController extends Controller {
    protected $simulacoes;

    public function __construct() {
        $this->simulacoes = new Simulacao();
    }

    // public function index() {
    //     $Datasimulacoes = $this->simulacoes->listar();
    //     $data = ["title" => "Simulações", "simulacoes" => $Datasimulacoes];
    //     $this->view('simulacoes', $data);
    // }
    public function index() {
        // Número de registros por página
        $registrosPorPagina = 20;
    
        // Obtém a página atual, se não estiver definida, assume a página 1
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    
        // Calcula o deslocamento para a consulta
        $deslocamento = ($paginaAtual - 1) * $registrosPorPagina;
    
        // Obtém os registros da base de dados com limite e deslocamento
        $Datasimulacoes = $this->simulacoes->listar($deslocamento, $registrosPorPagina);
    
        // Conta o total de registros para calcular o número total de páginas
        $totalRegistros = $this->simulacoes->contar(); // Método para contar total de registros
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
    
        // Prepara os dados para a view
        $data = [
            "title" => "Simulações",
            "simulacoes" => $Datasimulacoes,
            "paginaAtual" => $paginaAtual,
            "totalPaginas" => $totalPaginas
        ];
    
        // Carrega a view
        $this->view('simulacoes', $data);
    }
    
}
?>
