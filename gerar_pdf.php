<?php
// Importar a biblioteca DomPDF
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Dados do seguro (você pode obter esses dados de um formulário ou banco de dados)
$dados = [
    'data' => '09/01/2025',
    'cotacao' => '000009',
    'nome' => '',
    'contacto' => '',
    'morada' => '',
    'email' => '',
    'nif' => '',
    'modalidade' => '',
    'premio' => '',
    'dataInicio' => '',
    'dataVencimento' => '',
    'categoria' => '',
    'matricula' => '',
    'marca' => '',
    'modelo' => '',
    'cilindrada' => '',
    'anoFabrico' => '',
];

// Template HTML com capa
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Proposta de Cotação de Seguro de Automóvel</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .page-break {
            page-break-after: always;
        }
        /* Estilos para a capa */
        .capa {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .logo {
            position: absolute;
            top: 30px;
            left: 40px;
            width: 100px;
        }
        .faixas-verdes {
            position: absolute;
            top: 220px;
            left: 0;
            width: 100%;
            height: 40px;
            background-image: linear-gradient(
                to bottom,
                #4D9F50 0px, #4D9F50 8px,
                #0A8754 8px, #0A8754 16px,
                #00A786 16px, #00A786 24px,
                #00C0A0 24px, #00C0A0 32px,
                #00D5B2 32px, #00D5B2 40px
            );
        }
        .texto-capa {
            position: absolute;
            top: 290px;
            left: 40px;
        }
        .texto-capa h1 {
            font-size: 14px;
            margin: 0 0 5px 0;
            color: #333;
            font-weight: normal;
        }
        .texto-capa h2 {
            font-size: 24px;
            margin: 0 0 5px 0;
            color: #000;
            font-weight: bold;
        }
        .texto-capa h3 {
            font-size: 16px;
            margin: 0;
            color: #333;
        }
        .rodape-capa {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;
            background-color: #4D9F50;
            display: flex;
            align-items: center;
        }
        .contatos {
            position: absolute;
            bottom: 30px;
            left: 0;
            width: 100%;
            height: 20px;
            background-color: #f5f5f5;
            padding-left: 25px;
        }
        .contatos span {
            font-size: 10px;
            margin-right: 15px;
        }
        .redes-sociais {
            text-align: right;
            padding-right: 40px;
        }
        
        /* Estilos para as páginas de conteúdo */
        .content-page {
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 20px;
            margin: 5px 0;
        }
        .info-box {
            border: 1px solid #ccc;
            margin-bottom: 15px;
            padding: 10px;
        }
        .info-box h2 {
            font-size: 14px;
            margin: 0 0 5px 0;
            background-color: #f5f5f5;
            padding: 5px;
        }
        .row {
            display: block;
            width: 100%;
            overflow: hidden;
            margin-bottom: 5px;
        }
        .col {
            float: left;
            width: 48%;
        }
        .label {
            font-weight: bold;
            display: block;
        }
        .value {
            display: block;
            border-bottom: 1px dotted #ccc;
            padding: 3px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .footer {
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- Página de Capa -->
    <div class="capa">
        <div class="logo">
            <span style="color: #4D9F50; font-size: 24px; font-weight: bold;">TRAN</span><br>
            <span style="color: #0A8754; font-size: 24px; font-weight: bold;">QUILI</span><br>
            <span style="color: #00A786; font-size: 24px; font-weight: bold;">DADE</span>
        </div>
        
        <div class="faixas-verdes"></div>
        
        <div class="texto-capa">
            <h1>PROPOSTA DE COTAÇÃO DE SEGURO DE</h1>
            <h2>AUTOMÓVEL</h2>
            <h3>Opção VALOR</h3>
        </div>
        
        <div class="contatos">
            <span>📞 +555 197 555</span>
            <span>💬 seguro@tranquilidade.co.ao</span>
            <span>🌐 tranquilidade.ao</span>
        </div>
        
        <div class="rodape-capa">
            <div class="redes-sociais">
                <span style="color: white; font-size: 14px;">f in 📷</span>
            </div>
        </div>
    </div>
    
    <!-- Quebra de página após a capa -->
    <div class="page-break"></div>
    
    <!-- Páginas de conteúdo -->
    <div class="content-page">
        <div class="header">
            <h1>Simulação</h1>
            <h2>Seguro Automóvel</h2>
        </div>
        
        <div class="data-cotacao">
            <div class="row">
                <div class="col">
                    <span class="label">Data</span>
                    <span class="value">' . $dados['data'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Cotação nº</span>
                    <span class="value">' . $dados['cotacao'] . '</span>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>1. TOMADOR DE SEGURO / SEGURADO</h2>
            <div class="row">
                <div class="col">
                    <span class="label">Nome</span>
                    <span class="value">' . $dados['nome'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Contacto</span>
                    <span class="value">' . $dados['contacto'] . '</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">Morada</span>
                    <span class="value">' . $dados['morada'] . '</span>
                </div>
                <div class="col">
                    <span class="label">E-mail</span>
                    <span class="value">' . $dados['email'] . '</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">NIF</span>
                    <span class="value">' . $dados['nif'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Modalidade</span>
                    <span class="value">' . $dados['modalidade'] . '</span>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>2. PERÍODO SEGURO</h2>
            <div class="row">
                <div class="col">
                    <span class="label">Prêmio</span>
                    <span class="value">' . $dados['premio'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Data de Início</span>
                    <span class="value">' . $dados['dataInicio'] . '</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">Data de Vencimento</span>
                    <span class="value">' . $dados['dataVencimento'] . '</span>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>3. VIATURA(S) SEGURA(S)</h2>
            <div class="row">
                <div class="col">
                    <span class="label">Categoria</span>
                    <span class="value">' . $dados['categoria'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Matrícula</span>
                    <span class="value">' . $dados['matricula'] . '</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">Marca</span>
                    <span class="value">' . $dados['marca'] . '</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="label">Modelo</span>
                    <span class="value">' . $dados['modelo'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Cilindrada (cc)</span>
                    <span class="value">' . $dados['cilindrada'] . '</span>
                </div>
                <div class="col">
                    <span class="label">Ano de Fabrico</span>
                    <span class="value">' . $dados['anoFabrico'] . '</span>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>4. COBERTURAS / CAPITAIS / FRANQUIAS</h2>
            
            <table>
                <tr>
                    <th colspan="3">Opção ESSENCIAL (só RC)</th>
                </tr>
                <tr>
                    <td>RC - Responsabilidade Civil</td>
                    <td>Capital</td>
                    <td>Conforme decreto de 35/09 de 11 de agosto</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Franquia</td>
                    <td>Sem Franquia</td>
                </tr>
            </table>
            
            <br>
            
            <table>
                <tr>
                    <th colspan="3">Opção ESSENCIAL PLUS (RC + POC)</th>
                </tr>
                <tr>
                    <td>RC - Responsabilidade Civil</td>
                    <td>Capital</td>
                    <td>Conforme decreto de 35/09 de 11 de agosto</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Franquia</td>
                    <td>Sem Franquia</td>
                </tr>
                <tr>
                    <td>POC - Protecção de Ocupantes</td>
                    <td>Capital</td>
                    <td>Conforme capitais próprios da cobertura (*)</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Franquia</td>
                    <td>Sem Franquia</td>
                </tr>
            </table>
            
            <br>
            
            <table>
                <tr>
                    <th colspan="2">(*) Capitais POC</th>
                    <th>AOA</th>
                </tr>
                <tr>
                    <td colspan="2">Morte</td>
                    <td>2.500.000,00</td>
                </tr>
                <tr>
                    <td colspan="2">Despesas de Tratamento / Ocupantes</td>
                    <td>375.000,00</td>
                </tr>
                <tr>
                    <td colspan="2">Despesas de Tratamento / Condutor</td>
                    <td>500.000,00</td>
                </tr>
            </table>
            
            <p>Em caso de colocação, deve ser partilhada cópia da documentação oficial da viatura.</p>
            <p>Condições exclusivamente para viaturas de utilização particular, isto é, não abrange viaturas de aluguer.</p>
        </div>
        
        <div class="info-box">
            <h2>5. EXCLUSÕES</h2>
            <p>Aplicáveis as exclusões previstas nas Condições Gerais do Seguro Automóvel da Seguradora.</p>
            <p>Exclusão absoluta da circulação em zonas aeroportuárias de acesso restrito.</p>
        </div>
        
        <div class="info-box">
            <h2>6. FRACIONAMENTO</h2>
            <table>
                <tr>
                    <th>TOTAL (1)(2)(3)</th>
                    <th>AOA</th>
                </tr>
                <tr>
                    <td>Opção ESSENCIAL (RC)</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Opção ESSENCIAL PLUS (RC+POC)</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Opção VALOR PLUS (RC legal + QIV + POC + DP (2%))</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Opção VALOR PLUS RC legal + POC + DP (4%)</td>
                    <td></td>
                </tr>
            </table>
            
            <p>(1) Prémio Total Anual (em Kwanzas)</p>
            <p>(2) Modalidade de Pagamento: Anual, sem possibilidade de fraccionamento.</p>
            <p>(3) Os valores incluem IVA à taxa legal em vigor e todos os custos/encargos aplicáveis.</p>
        </div>
        
        <div class="info-box">
            <h2>7. CLAUSULADO APLICÁVEL</h2>
            <!-- Adicione aqui o conteúdo do clausulado se necessário -->
        </div>
        
        <div class="footer">
            <p>Este documento é apenas uma simulação e não constitui uma apólice de seguro.</p>
        </div>
    </div>
</body>
</html>
';

// Configurar o DomPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('defaultFont', 'Arial');

// Inicializar DomPDF
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);

// Configurar o tamanho do papel e orientação
$dompdf->setPaper('A4', 'portrait');

// Renderizar o PDF
$dompdf->render();

// Opcional: Salvar o PDF em um arquivo
file_put_contents('proposta_seguro_automovel.pdf', $dompdf->output());

// Opcional: Exibir o PDF no navegador
$dompdf->stream('proposta_seguro_automovel.pdf', ['Attachment' => false]);
?>