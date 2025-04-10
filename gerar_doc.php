<?php
require_once 'vendor/autoload.php'; // Carregar as dependências do Composer

use PhpOffice\PhpWord\TemplateProcessor;

// Função para preencher o template.docx com dados
function preencherTemplate($dados) {
    // Carregar o arquivo do template
    $templateProcessor = new TemplateProcessor('template.docx');
    
    // Substituir as variáveis do template com os dados
    foreach ($dados as $chave => $valor) {
        $templateProcessor->setValue($chave, $valor);
    }
    
    // Salvar o arquivo gerado
    $outputFile = 'resultado.docx';
    $templateProcessor->saveAs($outputFile);
    
    return $outputFile;
}

// Função para converter o arquivo .docx para PDF
function converterParaPDF($arquivoDocx) {
    // Configuração do Dompdf
    \PhpOffice\PhpWord\Settings::setPdfRendererName(\PhpOffice\PhpWord\Settings::PDF_RENDERER_DOMPDF);
    \PhpOffice\PhpWord\Settings::setPdfRendererPath('vendor/dompdf/dompdf');
    
    // Carregar o arquivo .docx preenchido
    $reader = \PhpOffice\PhpWord\IOFactory::load($arquivoDocx);
    
    // Criar o writer para gerar o PDF
    $writer = \PhpOffice\PhpWord\IOFactory::createWriter($reader, 'PDF');
    
    // Salvar o PDF gerado
    $pdfOutputFile = 'resultado.pdf';
    $writer->save($pdfOutputFile);
    
    return $pdfOutputFile;
}

// Dados para preencher o template
$dados = [
    'nome' => 'Simão José Mateus tipo deu',
    'matricula' => '28 anos',
    'marca' => 'Toyota',
    'modelo' => 'Rav-4',
    'cilindrada' => '2.0',
    'categoria' => 'Categoria 123',
    'ano' => '2023',
    'rc_legal' => '100px',
    'comercial_rc' => '200px',
    'data_actual' => '10/24/2023',
];

// Preencher o template com os dados
$arquivoPreenchido = preencherTemplate($dados);
echo "Template preenchido com sucesso. Arquivo salvo como: $arquivoPreenchido\n";

// Converter o arquivo preenchido para PDF
$pdfArquivo = converterParaPDF($arquivoPreenchido);
echo "Arquivo PDF gerado com sucesso. Arquivo salvo como: $pdfArquivo\n";
?>
