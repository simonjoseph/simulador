<?php

// Importar a biblioteca DomPDF
require_once __DIR__ . '/../../vendor/autoload.php';

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

    // public function index()
    // {
    //     $impostos = $this->modelo->listarImpostos();
    //     $tarifas = $this->modeloTarifa->listarTarifasPorCategoria();
    //     $modeloMarketing = $this->modeloMarketing->listar();
    //     $modeloCategorias = $this->modeloCategorias->listar();

    //     // print_r($modeloCategorias);
    //     // exit;
    //     $data = [
    //         "title" => "Bem-vindo ao Simulador",
    //         "impostos" => $impostos,
    //         "tarifas" => $tarifas,
    //         "campanhas" => $modeloMarketing,
    //         "modeloCategorias" => $modeloCategorias
    //     ];
    //     $this->view('home', $data);
    // }

    public function index()
{
    $impostos = $this->modelo->listarImpostos();
    $tarifas = $this->modeloTarifa->listarTarifasPorCategoria();
    $modeloMarketing = $this->modeloMarketing->listar();
    $modeloCategorias = $this->modeloCategorias->listar();

    // Filtrar campanhas no intervalo de datas
    $dataHoje = date('Y-m-d'); // Obtém a data de hoje no formato YYYY-MM-DD
    $campanhasFiltradas = array_filter($modeloMarketing, function($campanha) use ($dataHoje) {
        return $campanha['data_inicio'] <= $dataHoje && $campanha['data_fim'] >= $dataHoje;
    });

    $data = [
        "title" => "Bem-vindo ao Simulador",
        "impostos" => $impostos,
        "tarifas" => $tarifas,
        "campanhas" => $campanhasFiltradas, // Usar campanhas filtradas
        "modeloCategorias" => $modeloCategorias
    ];
    
    $this->view('home', $data);
}


    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

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


            $id_categoria_exist = $this->modeloCategorias->verificar_existencia($id_categoria);

            // Gerar a cotação ANTES de cadastrar
            $cotacao = $this->gerarCotacaoUnica();

            // Adicionando log para acompanhar o valor da cotação
            error_log("Cotação gerada: " . $cotacao);

            if (!empty($nome)) {
                $resultado = $this->simulacao->cadastrar(
                    $cotacao,  // Passamos a cotação já gerada
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
                    $id_categoria_exist,
                    $id_categoria,
                    $premio_rc_legal,
                    $premio_comercial_rc
                );

                // Verificar qual cotação foi realmente salva
                $cotacaoSalva = $this->simulacao->obterUltimaCotacao();
                error_log("Cotação salva no banco: " . $cotacaoSalva);

                if ($resultado) {
                    // Usar a cotação correta (a que foi realmente salva)
                    $cotacaoFinal = $cotacaoSalva ?: $cotacao;

                    // Em vez de redirecionar, retornamos um JSON com a URL para o cliente
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'cotacao' => $cotacaoFinal,
                        'redirectUrl' => "/simulador/home/baixarPdf?cotacao=$cotacaoFinal"
                    ]);
                    exit;
                } else {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'message' => "Erro ao cadastrar."
                    ]);
                    exit;
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => "Todos os campos são obrigatórios."
                ]);
                exit;
            }
        }

        // Se não for POST
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => "Método não permitido."]);
    }

    public function baixarPdf()
    {
        if (isset($_GET['cotacao'])) {
            $cotacao = $_GET['cotacao'];
            $dados = $this->simulacao->buscarPorCotacao($cotacao);


            // print_r ($dados);
            // exit;

            if ($dados) {
                $this->gerarPDF(
                    $dados['nome'],
                    $cotacao,
                    $dados['email'],
                    $dados['nif'],
                    $dados['contato'],
                    $dados['endereco'],
                    $dados['matricula'],
                    $dados['marca'],
                    $dados['modelo'],
                    $dados['cilindrada'],
                    $dados['ano_fabrico'],
                    $dados['data_inicio'],
                    $dados['id_categoria'],
                    $dados['nome_categoria'],
                    $dados['premio_rc_legal'],
                    $dados['premio_comercial_rc']
                );
            } else {
                echo "Cotação não encontrada.";
            }
        } else {
            echo "Cotação inválida.";
        }
    }

    private function gerarPDF(
        $nome,
        $cotacao,
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
        $nome_categoria,
        $premio_rc_legal,
        $premio_comercial_rc
    ) {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($options);
        $hoje = date("d/m/Y");

        $data = new DateTime($data_inicio);
        $data->modify('+1 year'); // Adiciona um ano
        $data->modify('-1 day'); // Subtrai um dia

        // $data_final = $data->format('d/m/Y');
        $data_final = $data->format('Y-m-d');

        $html = '
            <!DOCTYPE html>
            <html lang="pt">
            <head>
            <meta charset="UTF-8">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 11px;
                    line-height: 1.4;
                    color: #333;
                    max-width: 800px;
                    margin: 0 auto;
                    padding: 0px;
                }
                .header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 20px;
                }
                .logo {
                    color: #00af9e;
                    font-weight: bold;
                    font-size: 24px;
                    line-height: 1;
                }
                .logo img {
                    max-height: 60px;
                }
                .title {
                    text-align: left;
                    background-color: #f8f8f8;
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                }
                .title strong {
                    font-size: 11px;
                }
                .box {
                    border: 1px solid #ddd;
                    margin-bottom: 15px;
                    padding: 0;
                    border-radius: 5px;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                    overflow: hidden;
                }
                .section-title {
                    background-color: #00af9e;
                    color: white;
                    font-weight: bold;
                    padding: 7px 10px;
                    font-size: 12px;
                }
                .section-content {
                    padding: 10px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 0;
                }
                td, th {
                    border: 1px solid #ddd;
                    padding: 7px;
                    vertical-align: top;
                }
                th {
                    background-color: #f2f2f2;
                    text-align: left;
                }
                .no-border td {
                    border: none;
                }
                .no-border tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 9px;
                    border-top: 1px solid #ddd;
                    padding-top: 10px;
                    color: #666;
                }
                .green-box {
                    background-color: #00af9e;
                    color: white;
                    padding: 5px 8px;
                    font-weight: bold;
                    display: inline-block;
                    margin-bottom: 5px;
                    border-radius: 3px;
                }
                .label {
                    font-weight: bold;
                    color: #555;
                    width: 150px;
                }
                .value {
                    color: #333;
                }
                .price-highlight {
                    font-size: 14px;
                    font-weight: bold;
                    color: #00af9e;
                    padding: 5px;
                    background-color: #f2f2f2;
                    border-radius: 3px;
                    margin-top: 5px;
                }
                .option-header {
                    background-color: #f2f2f2;
                    text-align: center;
                    font-weight: bold;
                }
                .contact-info {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                }
                .contact-item {
                    margin-bottom: 5px;
                    flex-basis: 50%;
                }
                .validation-note {
                    font-style: italic;
                    text-align: center;
                    margin: 10px 0;
                    color: #666;
                }
            </style>
            </head>
            <body>
    
            <div class="header">
                <div class="logo">
                    <img src="https://tranquilidade.ao/storage/2024/04/2_trq_horizontal_cores_rgb.png" alt="Tranquilidade">
                </div>
                <div class="title">
                    <strong>Simulação de</strong>
                    <span>Seguro Automóvel</span>
                    <span>Data: ' . $hoje . '</span>
                    <span> Cotação nº: ' . $cotacao . ' </span>
                </div>
            </div>
    
            <div class="box">
                <div class="section-title">1. TOMADOR DE SEGURO / SEGURADO</div>
                <div class="section-content">
                    <table class="no-border">
                        <tr>
                            <td class="label">Nome:</td>
                            <td class="value">' . $nome . '</td>
                            <td class="label">Contacto:</td>
                            <td class="value">' . $contato . '</td>
                        </tr>
                        <tr>
                            <td class="label">Morada:</td>
                            <td class="value">' . $endereco . '</td>
                            <td class="label">Email:</td>
                            <td class="value">' . $email . '</td>
                        </tr>
                        <tr>
                            <td class="label">NIF:</td>
                            <td class="value">' . $nif . '</td>
                            <td class="label">Modalidade:</td>
                            <td class="value">Anual</td>
                        </tr>
                    </table>
                </div>
            </div>
    
            <div class="box">
                <div class="section-title">2. PERIODO SEGURO</div>
                <div class="section-content">
                    <table class="no-border">
                        <tr>
                            <td class="label">Data de Início:</td>
                            <td class="value">' . $data_inicio . '</td>
                            <td class="label">Data de Vencimento:</td>
                            <td class="value">' . $data_final . '</td>
                        </tr>
                    </table>
                </div>
            </div>
    
            <div class="box">
                <div class="section-title">3. VIATURA(S) SEGURA(S)</div>
                <div class="section-content">
                    <table class="no-border">
                        <tr>
                            <td class="label">Categoria:</td>
                            <td class="value">'. $nome_categoria .'</td>
                            <td class="label">Matrícula:</td>
                            <td class="value">' . $matricula . '</td>
                        </tr>
                        <tr>
                            <td class="label">Modelo:</td>
                            <td class="value">' . $modelo . '</td>
                            <td class="label">Cilindrada(cc):</td>
                            <td class="value">' . $cilindrada . '</td>
                        </tr>
                        <tr>
                            <td class="label">Marca:</td>
                            <td class="value">' . $marca . '</td>
                            <td class="label">Ano de Fabrico:</td>
                            <td class="value">' . $ano_fabrico . '</td>
                        </tr>
                    </table>
                </div>
            </div>
    
            <div class="box">
                <div class="section-title">4. COBERTURAS / CAPITAIS / FRANQUIAS</div>
                <div class="section-content">
                    <table>
                        <tr>
                            <th style="width: 30%;">Cobertura</th>
                            <th class="option-header">Opção ESSENCIAL<br>(Só RC)</th>
                            <th class="option-header">Opção ESSENCIAL PLUS<br>(RC + POC)</th>
                        </tr>
                        <tr>
                            <td><strong>RC - Responsabilidade Civil</strong></td>
                            <td>Conforme decreto 345/10 de 11 de agosto<br><em>Sem Franquia</em></td>
                            <td>Conforme decreto 345/10 de 11 de agosto<br><em>Sem Franquia</em></td>
                        </tr>
                        <tr>
                            <td><strong>POC - Protecção de Ocupantes (*)</strong></td>
                            <td style="text-align: center;">—</td>
                            <td>
                                <strong>Morte:</strong> 2.500.000,00 AOA<br>
                                <strong>Despesas de Tratamento / Ocupantes:</strong> 375.000,00 AOA<br>
                                <strong>Despesas de Tratamento / Condutor:</strong> 500.000,00 AOA
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
    
            <div class="box">
                <div class="section-title">5. EXCLUSÕES</div>
                <div class="section-content">
                    <p>Aplicáveis as exclusões previstas nas Condições Gerais do Seguro Automóvel da Seguradora.</p>
                </div>
            </div>
    
            <div class="box">
                <div class="section-title">6. FRACCIONAMENTO</div>
                <div class="section-content">
                    <p><strong>TOTAL (1/2/3/1)</strong></p>
                    <div class="price-highlight">Opção ESSENCIAL (RC): ' . $premio_rc_legal . ' AOA</div>
                    <div class="price-highlight">Opção ESSENCIAL PLUS (RC+POC): ' . $premio_comercial_rc . ' AOA</div>
                </div>
            </div>
    
            <div class="box">
                <div class="section-title">7. CLAUSULADO APLICÁVEL</div>
                <div class="section-content">
                    <p>Aplicáveis as Condições Gerais e Especiais do Seguro Automóvel Uniforme – Tranquilidade Corporação Angolana de Seguros.</p>
                </div>
            </div>
    
            <div class="box">
                <div class="section-title">ENTIDADE: TRANQUILIDADE CORPORAÇÃO ANGOLANA DE SEGUROS S.A</div>
                <div class="section-content">
                    <p><strong>Conta:</strong> A006 5069 0104 0100 0658 2999 4</p>
                </div>
            </div>
    
            <div class="validation-note">
                Esta proposta tem validade de 30 dias a contar da presente data.
            </div>
    
            <div class="footer">
                <div class="green-box">TRANQUILIDADE – Corporação Angolana de Seguros, S.A.</div>
                <div class="contact-info">
                    <span class="contact-item"><strong>Telefones:</strong> +244 936 197 550 / 1 / 2</span>
                    <span class="contact-item"><strong>WhatsApp:</strong> +244 936 197 550 / 1</span>
                    <span class="contact-item"><strong>Email:</strong> apoio@tranquilidade.co.ao</span>
                    <span class="contact-item"><strong>Site:</strong> www.tranquilidade.ao</span>
                </div>
                <div style="margin-top: 3px;">
                    <strong>Endereço:</strong> Rua Marechal Brós Tito, 35 15º Andar, Edifício ESCOM Luanda – Angola
                </div>
            </div>
    
            </body>
            </html>
        ';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Enviar o PDF diretamente para o navegador
        $dompdf->stream("simulacao_$cotacao.pdf", ["Attachment" => false]);
        exit;
    }

    // private function gerarCotacaoUnica()
    // {
    //     $timestamp = date("YmdHis"); // Formato: YYYYMMDDHHMMSS
    //     $contador = 1;

    //     $cotacaoUnica = $contador . $timestamp;

    //     while ($this->simulacao->cotacaoExiste($cotacaoUnica)) {
    //         $contador++;
    //         $cotacaoUnica = $contador . $timestamp;
    //     }

    //     return $cotacaoUnica;
    // }

    private function gerarCotacaoUnica()
{
    $anoAtual = date("Y"); // Obtém o ano atual (ex: 2025)
    $base = 10000; // Número base para iniciar a contagem
    
    // Buscar a última cotação no banco de dados
    $ultimaCotacao = $this->simulacao->obterUltimaCotacao();
    
    if ($ultimaCotacao) {
        // Se existir uma cotação anterior, extrair o número sequencial
        // Assumindo que o formato é YYYY10000, YYYY10001, etc.
        $anoAnterior = substr($ultimaCotacao, 0, 4);
        $numeroAnterior = (int)substr($ultimaCotacao, 4);
        
        if ($anoAnterior == $anoAtual) {
            // Se for do mesmo ano, incrementa o número
            $numeroSequencial = $numeroAnterior + 1;
        } else {
            // Se for de um ano diferente, reinicia a contagem
            $numeroSequencial = $base;
        }
    } else {
        // Se não existir cotação anterior, começa do número base
        $numeroSequencial = $base;
    }
    
    $cotacaoUnica = $anoAtual . $numeroSequencial;
    
    // Verificar se já existe essa cotação (improvável, mas por segurança)
    while ($this->simulacao->cotacaoExiste($cotacaoUnica)) {
        $numeroSequencial++;
        $cotacaoUnica = $anoAtual . $numeroSequencial;
    }
    
    return $cotacaoUnica;
}
}
