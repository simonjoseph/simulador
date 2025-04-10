<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'core/Controller.php';
require_once __DIR__ . '/../Models/Imposto.php';
require_once __DIR__ . "/../Models/Tarifa.php";
require_once __DIR__ . "/../Models/CampanhaMarketing.php";
require_once __DIR__ . "/../Models/Category.php";
require_once __DIR__ . "/../Models/Simulacao.php";

class HomeController extends Controller
{

    protected $modelo;
    protected $modeloTarifa;
    protected $modeloMarketing;
    protected $modeloCategorias;
    protected $simulacao;

    public function __construct()
    {
        $this->modelo = new Imposto();
        $this->modeloTarifa = new Tarifa();
        $this->modeloMarketing = new CampanhaMarketing();
        $this->modeloCategorias = new Category();
        $this->simulacao = new Simulacao();
    }

    public function index()
    {
        $impostos = $this->modelo->listarImpostos();
        $tarifas = $this->modeloTarifa->listarTarifasPorCategoria();
        $modeloMarketing = $this->modeloMarketing->listar();
        $modeloCategorias = $this->modeloCategorias->listar();

        // print_r($modeloCategorias);
        // exit;
        $data = [
            "title" => "Bem-vindo ao Simulador",
            "impostos" => $impostos,
            "tarifas" => $tarifas,
            "campanhas" => $modeloMarketing,
            "modeloCategorias" => $modeloCategorias
        ];
        $this->view('home', $data);
    }

    // public function create()
    // {
    //     if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
    //         // Inicia sessão se ainda não foi iniciada
    //         if (session_status() === PHP_SESSION_NONE) {
    //             session_start();
    //         }

    //         // Coleta e sanitiza os dados
    //         $nome = htmlspecialchars($_POST["nome"], ENT_QUOTES, "UTF-8");
    //         $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
    //         $nif = htmlspecialchars($_POST["nif"], ENT_QUOTES, "UTF-8");
    //         $contato = htmlspecialchars($_POST["contato"], ENT_QUOTES, "UTF-8");
    //         $endereco = htmlspecialchars($_POST["endereco"], ENT_QUOTES, "UTF-8");
    //         $matricula = htmlspecialchars($_POST["matricula"], ENT_QUOTES, "UTF-8");
    //         $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, "UTF-8");
    //         $modelo = htmlspecialchars($_POST["modelo"], ENT_QUOTES, "UTF-8");
    //         $cilindrada = htmlspecialchars($_POST["cilindrada"], ENT_QUOTES, "UTF-8");
    //         $ano_fabrico = htmlspecialchars($_POST["ano_fabrico"], ENT_QUOTES, "UTF-8");
    //         $data_inicio = htmlspecialchars($_POST["data_inicio"], ENT_QUOTES, "UTF-8");
    //         $id_categoria = htmlspecialchars($_POST["id_categoria"], ENT_QUOTES, "UTF-8");
    //         $premio_rc_legal = htmlspecialchars($_POST["premio_rc_legal"], ENT_QUOTES, "UTF-8");
    //         $premio_comercial_rc = htmlspecialchars($_POST["premio_comercial_rc"], ENT_QUOTES, "UTF-8");

    //         // Verifica campos obrigatórios
    //         if (!empty($nome)) {
    //             $resultado = $this->simulacao->cadastrar(
    //                 $nome,
    //                 $email,
    //                 $nif,
    //                 $contato,
    //                 $endereco,
    //                 $matricula,
    //                 $marca,
    //                 $modelo,
    //                 $cilindrada,
    //                 $ano_fabrico,
    //                 $data_inicio,
    //                 $id_categoria,
    //                 $premio_rc_legal,
    //                 $premio_comercial_rc
    //             );

    //             // Retorna resposta em JSON para o front
    //             header('Content-Type: application/json');
    //             echo json_encode([
    //                 'success' => $resultado,
    //                 'message' => $resultado ? "Simulação Feita com sucesso!" : "Erro ao cadastrar a Simulação."
    //             ]);
    //             exit;
    //         } else {
    //             header('Content-Type: application/json');
    //             echo json_encode([
    //                 'success' => false,
    //                 'message' => "Todos os campos são obrigatórios."
    //             ]);
    //             exit;
    //         }
    //     }

    //     // Se não for POST
    //     http_response_code(405);
    //     echo "Método não permitido.";
    // }

    // 
    // 
    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
            // Inicia sessão se ainda não foi iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Coleta e sanitiza os dados
            $nome = htmlspecialchars($_POST["nome"], ENT_QUOTES, "UTF-8");
            $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
            $nif = htmlspecialchars($_POST["nif"], ENT_QUOTES, "UTF-8");
            $contato = htmlspecialchars($_POST["contato"], ENT_QUOTES, "UTF-8");
            $endereco = htmlspecialchars($_POST["endereco"], ENT_QUOTES, "UTF-8");
            $matricula = htmlspecialchars($_POST["matricula"], ENT_QUOTES, "UTF-8");
            $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, "UTF-8");
            $modelo = htmlspecialchars($_POST["modelo"], ENT_QUOTES, "UTF-8");
            $cilindrada = htmlspecialchars($_POST["cilindrada"], ENT_QUOTES, "UTF-8");
            $ano_fabrico = htmlspecialchars($_POST["ano_fabrico"], ENT_QUOTES, "UTF-8");
            $data_inicio = htmlspecialchars($_POST["data_inicio"], ENT_QUOTES, "UTF-8");
            $id_categoria = htmlspecialchars($_POST["id_categoria"], ENT_QUOTES, "UTF-8");
            $premio_rc_legal = htmlspecialchars($_POST["premio_rc_legal"], ENT_QUOTES, "UTF-8");
            $premio_comercial_rc = htmlspecialchars($_POST["premio_comercial_rc"], ENT_QUOTES, "UTF-8");

            // Gera cotação única
            $cotacao = $this->gerarCotacaoUnica();

            // Verifica campos obrigatórios
            if (!empty($nome)) {
                $resultado = $this->simulacao->cadastrar(
                    $cotacao,
                    $nome,
                    $email,
                    $nif,
                    $contato,
                    $endereco,
                    $matricula,
                    $marca,
                    $modelo,
                    $cilindrada,
                    $ano_fabrico,
                    $data_inicio,
                    $id_categoria,
                    $premio_rc_legal,
                    $premio_comercial_rc
                );

                // Se o cadastro for bem-sucedido, gera o PDF
                if ($resultado) {
                    // $this->gerarPDF($nome, $cotacao, $email, $contato, $endereco); // Chama o método para gerar o PDF
                    header("Location: /simulador/home/baixarPdf?cotacao=$cotacao");
                    exit;
                } else {
                    $_SESSION["error"] = "Erro ao cadastrar.";
                    header('Location: /simulador/home');
                    exit;
                }
            } else {
                $_SESSION["error"] = "Todos os campos são obrigatórios.";
                header('Location: /simulador/home');
                exit;
            }
        }

        // Se não for POST
        http_response_code(405);
        echo "Método não permitido.";
    }

    public function baixarPdf()
    {
        if (isset($_GET['cotacao'])) {
            $cotacao = $_GET['cotacao'];
            $dados = $this->simulacao->buscarPorCotacao($cotacao);

            if ($dados) {
                $this->gerarPDF(
                    $dados['nome'],
                    $cotacao,
                    $dados['email'],
                    $dados['contato'],
                    $dados['endereco']
                );
            } else {
                echo "Cotação não encontrada.";
            }
        } else {
            echo "Cotação inválida.";
        }
    }

    // Função para gerar o PDF
    private function gerarPDF($nome, $cotacao, $email, $contato, $endereco)
    {
        // Crie o conteúdo do PDF
        $html = "<h1>Simulação de Cotação</h1>";
        $html .= "<p>Nome: $nome</p>";
        $html .= "<p>Cotação: $cotacao</p>";
        $html .= "<p>Email: $email</p>";
        $html .= "<p>Contato: $contato</p>";
        $html .= "<p>Endereço: $endereco</p>";
        // Adicione outros dados ao PDF conforme necessário

        // Instancia o Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Carrega o conteúdo HTML
        $dompdf->loadHtml($html);

        // (Opcional) Define o tamanho e a orientação do papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza o PDF
        $dompdf->render();

        // Envia os cabeçalhos para forçar o download do PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="simulacao.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Expires: 0');
        header('Pragma: public');

        // Exibe o PDF
        echo $dompdf->output();
        exit;
    }

    // Função para gerar uma cotação única
    private function gerarCotacaoUnica()
    {
        // Obtém a data e hora atual
        $timestamp = date("YmdHis"); // Formato: YYYYMMDDHHMMSS
        $contador = 1; // Inicia com 1

        // Gera a cotação inicial
        $cotacaoUnica = $contador . $timestamp;

        // Verifica se já existe uma cotação igual
        while ($this->simulacao->cotacaoExiste($cotacaoUnica)) {
            $contador++;
            $cotacaoUnica = $contador . $timestamp; // Gera nova cotação
        }

        return $cotacaoUnica;
    }


    // 
    // 

    // 
    // here
    // public function gerarPdf()
    // {
    // if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //     $nome = htmlspecialchars($_POST["nome"], ENT_QUOTES, "UTF-8");
    //     $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
    //     $nif = htmlspecialchars($_POST["nif"], ENT_QUOTES, "UTF-8");
    //     $contato = htmlspecialchars($_POST["contato"], ENT_QUOTES, "UTF-8");
    //     $endereco = htmlspecialchars($_POST["endereco"], ENT_QUOTES, "UTF-8");
    //     $matricula = htmlspecialchars($_POST["matricula"], ENT_QUOTES, "UTF-8");
    //     $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, "UTF-8");
    //     $modelo = htmlspecialchars($_POST["modelo"], ENT_QUOTES, "UTF-8");
    //     $cilindrada = htmlspecialchars($_POST["cilindrada"], ENT_QUOTES, "UTF-8");
    //     $ano_fabrico = htmlspecialchars($_POST["ano_fabrico"], ENT_QUOTES, "UTF-8");
    //     $data_inicio = htmlspecialchars($_POST["data_inicio"], ENT_QUOTES, "UTF-8");
    //     $id_categoria = htmlspecialchars($_POST["id_categoria"], ENT_QUOTES, "UTF-8");
    //     $premio_rc_legal = htmlspecialchars($_POST["premio_rc_legal"], ENT_QUOTES, "UTF-8");
    //     $premio_comercial_rc = htmlspecialchars($_POST["premio_comercial_rc"], ENT_QUOTES, "UTF-8");

    //     $html = "
    //         <h1>Informações da Simulação</h1>
    //         <p><strong>Nome:</strong> $nome</p>
    //         <p><strong>Email:</strong> $email</p>
    //         <p><strong>NIF:</strong> $nif</p>
    //         <p><strong>Contato:</strong> $contato</p>
    //         <p><strong>Endereço:</strong> $endereco</p>
    //         <p><strong>Matrícula:</strong> $matricula</p>
    //         <p><strong>Marca:</strong> $marca</p>
    //         <p><strong>Modelo:</strong> $modelo</p>
    //         <p><strong>Cilindrada:</strong> $cilindrada</p>
    //         <p><strong>Ano de Fabrico:</strong> $ano_fabrico</p>
    //         <p><strong>Data Início:</strong> $data_inicio</p>
    //         <p><strong>Categoria:</strong> $id_categoria</p>
    //         <p><strong>Prémio RC Legal:</strong> $premio_rc_legal</p>
    //         <p><strong>Prémio Comercial RC:</strong> $premio_comercial_rc</p>
    //     ";


    //     $nome = "Simao";
    //     $html = "
    //             <h1>Informações da Simulação</h1>
    //             <p><strong>Nome:</strong> $nome</p>
    //         ";

    //     $options = new Options();
    //     $options->set('defaultFont', 'Arial');

    //     $dompdf = new Dompdf($options);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // Envia o PDF para download
    //     $dompdf->stream("simulacao_$nome.pdf", ["Attachment" => true]);
    //     exit;
    //     // }
    // }
    // 
}
