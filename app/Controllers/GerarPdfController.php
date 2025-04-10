<?php
require 'vendor/autoload.php'; // ou ajuste para seu autoload do Dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

    // Monta o HTML
    $html = "
        <h1>Informações da Simulação</h1>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>NIF:</strong> $nif</p>
        <p><strong>Contato:</strong> $contato</p>
        <p><strong>Endereço:</strong> $endereco</p>
        <p><strong>Matrícula:</strong> $matricula</p>
        <p><strong>Marca:</strong> $marca</p>
        <p><strong>Modelo:</strong> $modelo</p>
        <p><strong>Cilindrada:</strong> $cilindrada</p>
        <p><strong>Ano de Fabrico:</strong> $ano_fabrico</p>
        <p><strong>Data Início:</strong> $data_inicio</p>
        <p><strong>Categoria:</strong> $id_categoria</p>
        <p><strong>Prémio RC Legal:</strong> $premio_rc_legal</p>
        <p><strong>Prémio Comercial RC:</strong> $premio_comercial_rc</p>
    ";

    $options = new Options();
    $options->set('defaultFont', 'Arial');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Envia o PDF para download
    $dompdf->stream("simulacao_$nome.pdf", ["Attachment" => true]);
    exit;
}
