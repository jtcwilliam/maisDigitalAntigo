<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require('classes/fpdf186/fpdf.php');
include_once 'classes/arquivo.php';
require_once('classes/FPDI/src/autoload.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

require_once('vendor/autoload.php'); // Se estiver usando composer

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PdfReader;


$pdf = new Fpdi();

$objArquivo = new Arquivo();




$arquivos = $objArquivo->consultarArquivoParaSolicitacaoTeste(155);


$pdf = new Fpdi();
$pageCount = $pdf->setSourceFile($temp_file);

// Verifica se há assinaturas digitais no documento
$reader = new PdfReader($temp_file);
$signatures = $reader->getSignatures();

if (empty($signatures)) {
    echo "O documento não possui assinaturas digitais.";
    unlink($temp_file); // Remove o arquivo temporário
    exit;
}

// Para cada assinatura, realiza a validação
foreach ($signatures as $signature) {
    $valid = $signature->isValid();

    if ($valid) {
        echo "Assinatura válida. \n";
    } else {
        echo "Assinatura inválida. \n";
    }
}

unlink($temp_file); // Remove o arquivo temporário