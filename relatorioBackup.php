<?php


ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require('classes/fpdf186/fpdf.php');
include_once 'classes/arquivo.php';
require_once('classes/FPDI/src/autoload.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

use setasign\Fpdi\Fpdi;

$objArquivo = new Arquivo();

$idSolicitacao = $_GET['idSolicitacao'];

$dadosSolicitacao = $objArquivo->solicitarArquivoRelatorio($idSolicitacao);

$arquivos = $objArquivo->consultarArquivoParaSolicitacaoRelatorio($idSolicitacao);





$mes = $dadosSolicitacao[0]['mes'];

setlocale(LC_TIME, 'pt_BR.utf8');
$mes = $mes;

$dataDaSol = 'Guarulhos, ' . $dadosSolicitacao[0]['dias'] . $mes . $dadosSolicitacao[0]['ano'];

// Criar PDF com FPDF + FPDI
$pdf = new Fpdi();

$pdf->AddPage();

$pdf->Image('logoPrefeitura.png', 5, 10, 60);
$pdf->SetFont('Arial', 'B', 30);


$pdf->Text(65, 31, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Requerimento Padrão'));

$pdf->SetFont('Arial', '', 13);
$pdf->Text(10, 43, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Ao Excelentíssimo Senhor Prefeito do Município de Guarulhos'));
$pdf->Cell(190, 35, '', 0, 1, 'C');


$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 6, 'Dados Pessoais', 1, 1, 'C');

// Texto com negrito e normal + alinhamento justificado
$pdf->SetFont('Arial', '', 13);
$pdf->SetX(10);
$pdf->MultiCell(0, 6, '', 0, 'J'); // Reservar área
$pdf->SetXY(10, 53, $pdf->GetY());
$pdf->WriteHTML(iconv("UTF-8", "ISO-8859-1//TRANSLIT", "<b>Nome do Solicitante:</b> " . $dadosSolicitacao[0]['nome_pessoa'] . "<br><br><b>CPF ou CNPJ:</b> " . $dadosSolicitacao[0]['docSolicitacaoPessoal'] . " 
<br><br><b>Email:</b> " . $dadosSolicitacao[0]['email_usuario'] . " <br> <br><b>Endereço: </b>" . $dadosSolicitacao[0]['logradouroSol'] .
    ", " . $dadosSolicitacao[0]['numeroSol'] . ". " . $dadosSolicitacao[0]['complemento'] . "  " . $dadosSolicitacao[0]['bairro'] . " <br><br><b>" . $dadosSolicitacao[0]['descricaoDoc'] . ":</b> " . $dadosSolicitacao[0]['documentoPublico'] . "<b><br><br>Venho, respeitosamente, solicitar</b><br><i><center>"
    . $dadosSolicitacao[0]['descricaoCarta'] . "<center></i>.<br><br><b>Complemento da Solicitação</b>:  <br>" . $dadosSolicitacao[0]['descricaoSolicitacao'] . " <br>  "));



$pdf->SetXY(10, 230, $pdf->GetY());

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 8, $dataDaSol, 0, 0, 'j');

$base64 =   $dadosSolicitacao[0]['assinaturaSolicitacao'];

// Remover o prefixo data:image/png;base64,
$base64 = str_replace('data:image/png;base64,', '', $base64);
$base64 = str_replace(' ', '+', $base64);

// Decodificar base64
$data = base64_decode($base64);

// Criar arquivo temporário
$file = 'temp_image.png';
file_put_contents($file, $data);
$pdf->SetXY(10, 260, $pdf->GetY());


if ($dadosSolicitacao[0]['representaTerceiro'] == '1') {

    $base64Terceiro =   $dadosSolicitacao[0]['assinaturaTerceiro'];

    // Remover o prefixo data:image/png;base64,
    $base64Terceiro = str_replace('data:image/png;base64,', '', $base64Terceiro);
    $base64Terceiro = str_replace(' ', '+', $base64Terceiro);

    // Decodificar base64
    $data = base64_decode($base64Terceiro);

    // Criar arquivo temporário
    $fileTerceiro = 'temp_imageB.png';
    file_put_contents($fileTerceiro, $data);



    // Adicionar imagem no PDF
    $pdf->Image($fileTerceiro, 90, 240, 130, 0, 'PNG');




    // Adicionar imagem no PDF
    $pdf->Image($file, 0, 240, 130, 0, 'PNG');




    //

    $pdf->Cell(90, 7, $dadosSolicitacao[0]['nome_pessoa'], 0, 0, 'C'); // 1 = borda, 0 = continua na mesma linha

    // --- Segunda célula ---
    // A posição da segunda célula é determinada pela largura da anterior
    $pdf->Cell(90, 7, $dadosSolicitacao[0]['nomeTerceiro'], 0, 1, 'C'); // 1 = borda, 1 = vai para a próxima linha (após esta célula)


    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(90, 5, 'Procurador', 0, 0, 'C'); // 1 = borda, 0 = continua na mesma linha

    // --- Segunda célula ---
    // A posição da segunda célula é determinada pela largura da anterior
    $pdf->Cell(90, 5, 'Interessado', 0, 1, 'C');

    unlink($fileTerceiro);
    unlink($file);
} else {


    // Adicionar imagem no PDF
    $pdf->Image($file, 50, 240, 130, 0, 'PNG');




    //

    $pdf->Cell(190, 7, $dadosSolicitacao[0]['nome_pessoa'], 0, 0, 'C'); // 1 = borda, 0 = continua na mesma linha

    unlink($file);
}


//inicio procurador
if ($dadosSolicitacao[0]['representaTerceiro'] == '1') {



    $mes = $dadosSolicitacao[0]['mes'];

    setlocale(LC_TIME, 'pt_BR.utf8');
    $mes = $mes;

    $dataDaSol = 'Guarulhos, ' . $dadosSolicitacao[0]['dias'] . $mes . $dadosSolicitacao[0]['ano'];



    $pdf->AddPage();

    $pdf->Image('logoPrefeitura.png', 5, 10, 60);
    $pdf->SetFont('Arial', 'B', 30);


    $pdf->Text(65, 31, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Requerimento Padrão'));

    $pdf->SetFont('Arial', '', 13);
    $pdf->Text(10, 43, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Ao Excelentíssimo Senhor Prefeito do Município de Guarulhos'));
    $pdf->Cell(190, 35, '', 0, 1, 'C');


    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Cell(190, 6, 'Dados Pessoais', 1, 1, 'C');

    // Texto com negrito e normal + alinhamento justificado
    $pdf->SetFont('Arial', '', 13);
    $pdf->SetX(10);
    $pdf->MultiCell(0, 6, '', 0, 'J'); // Reservar área
    $pdf->SetXY(10, 53, $pdf->GetY());
    $pdf->WriteHTML(iconv("UTF-8", "ISO-8859-1//TRANSLIT", "<b>Nome do Solicitante:</b> " . $dadosSolicitacao[0]['nomeTerceiro'] . "<br><br><b>CPF ou CNPJ:</b> " . $dadosSolicitacao[0]['documentoTerceiro'] . " 
<br><br><b>Email:</b> " . $dadosSolicitacao[0]['emailTerceiro'] . " <br> <br><b>Endereço: </b>" . $dadosSolicitacao[0]['logradouroSol'] .
        ", " . $dadosSolicitacao[0]['numeroSol'] . ". " . $dadosSolicitacao[0]['complemento'] . "  " . $dadosSolicitacao[0]['bairro'] . " <br><br><b>" . $dadosSolicitacao[0]['descricaoDoc'] . ":</b> " . $dadosSolicitacao[0]['documentoPublico'] . "<b><br><br>Venho, respeitosamente, solicitar</b><br><i><center>"
        . $dadosSolicitacao[0]['descricaoCarta'] . "<center></i>.<br><br><b>Complemento da Solicitação</b>:  <br>" . $dadosSolicitacao[0]['descricaoSolicitacao'] . " <br>  "));



    $pdf->SetXY(10, 230, $pdf->GetY());

    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Cell(190, 8, $dataDaSol, 0, 0, 'j');

    $base64 =   $dadosSolicitacao[0]['assinaturaSolicitacao'];

    // Remover o prefixo data:image/png;base64,
    $base64 = str_replace('data:image/png;base64,', '', $base64);
    $base64 = str_replace(' ', '+', $base64);

    // Decodificar base64
    $data = base64_decode($base64);

    // Criar arquivo temporário
    $file = 'temp_image.png';
    file_put_contents($file, $data);
    $pdf->SetXY(10, 260, $pdf->GetY());


    if ($dadosSolicitacao[0]['representaTerceiro'] == '1') {

        $base64Terceiro =   $dadosSolicitacao[0]['assinaturaTerceiro'];

        // Remover o prefixo data:image/png;base64,
        $base64Terceiro = str_replace('data:image/png;base64,', '', $base64Terceiro);
        $base64Terceiro = str_replace(' ', '+', $base64Terceiro);

        // Decodificar base64
        $data = base64_decode($base64Terceiro);

        // Criar arquivo temporário
        $fileTerceiro = 'temp_imageB.png';
        file_put_contents($fileTerceiro, $data);



        // Adicionar imagem no PDF
        $pdf->Image($fileTerceiro, 40, 240, 130, 0, 'PNG');


 




        //

 
        // A posição da segunda célula é determinada pela largura da anterior
        $pdf->Cell(200, 7, $dadosSolicitacao[0]['nomeTerceiro'], 0, 1, 'C'); // 1 = borda, 1 = vai para a próxima linha (após esta célula)
        $pdf->SetFont('Arial', '', 11);
           $pdf->Cell(200, 5, 'Interessado', 0, 1, 'C');


   

        unlink($fileTerceiro);
        unlink($file);
    } else {


     
 
    }
}

//fim procurador









$tempPdfFile = array();
$tempIMGFile = array();

$w = 0;

//
foreach ($arquivos as $key => $value) {

    switch ($value['tipoArquivo']) {

        case 'application/pdf':
            $pdf->AddPage();
            $pdf->SetXY(11, 145, $pdf->GetY());
            $pdf->SetFont('Arial', 'B', 23);
            $pdf->Cell(190, 10,  'Documento anexado pelo Solicitante', 0, true, 'J');
            $pdf->SetFont('Arial', '', 13);


            $pdf->WriteHTML("<p style='text-align: center'>" . iconv("UTF-8", "ISO-8859-1//TRANSLIT", $value['nomeArquivo']) . "</style> ");




            //$pdf->Cell(0, 20,  utf8_decode($value['nomeArquivo']), 0, true, 'C');

                //'pagamentoPraia.pdf'

                $_arquivos = file_get_contents('pagamentoPraia.pdf');


            $pdfData[$w] = $value['arquivo'];

            //colocar o registro do banco em uma variavel
            //$pdfData[$w] = $value['arquivo'];

            //cria um arquivo temporário para rechear com o pdf
            $tempPdf[$w] = 'temp_pdf' . $w . '.pdf';

            array_push($tempPdfFile, $tempPdf[$w]);

            //coloca os dados nesse arquivo temporário
            file_put_contents($tempPdf[$w], $pdfData[$w]);


            $pageCount = $pdf->setSourceFile($tempPdf[$w]);
            for ($i = 1; $i <= $pageCount; $i++) {
                $templateId = $pdf->importPage($i);

                $pdf->AddPage();

                $pdf->useTemplate($templateId, 10, 10, 170);
            }




            break;


        case 'image/png':

            $pdf->AddPage();
            $pdf->SetXY(11, 145, $pdf->GetY());
            $pdf->SetFont('Arial', 'B', 23);
            $pdf->Cell(190, 10,  'Documento anexado pelo Solicitante', 0, true, 'J');
            $pdf->SetFont('Arial', '', 13);


            $pdf->WriteHTML("<p style='text-align: center'>" . iconv("UTF-8", "ISO-8859-1//TRANSLIT", $value['nomeArquivo']) . "</style> ");

            $pdf->AddPage();
            //insere a imagem nessa variavel
            $imgData[$w] = $value['arquivo'];

            //criação de um arquivo temporário
            $tempImg[$w] = 'temp_img' . $w . '.png';

            array_push($tempIMGFile, $tempImg[$w]);

            //recheando o pdf com esse arquivo
            file_put_contents($tempImg[$w], $imgData[$w]);



            //criando uma nova imagem
            $pdf->Image($tempImg[$w], 10, 10, 180); // Ajuste posição/tamanho




            break;

        case 'image/jpeg':

            $pdf->AddPage();
            $pdf->SetXY(11, 145, $pdf->GetY());
            $pdf->SetFont('Arial', 'B', 23);
            $pdf->Cell(190, 10,  'Documento anexado pelo Solicitante', 0, true, 'J');
            $pdf->SetFont('Arial', '', 13);


            $pdf->WriteHTML("<p style='text-align: center'>" .  iconv("UTF-8", "ISO-8859-1//TRANSLIT", $value['nomeArquivo']) . "</style> ");

            $pdf->AddPage();

            //insere a imagem nessa variavel
            $imgData[$w] = $value['arquivo'];

            //criação de um arquivo temporário
            $tempImg[$w] = 'temp_img' . $w . '.jpg';

            array_push($tempIMGFile, $tempImg[$w]);

            //recheando o pdf com esse arquivo
            file_put_contents($tempImg[$w], $imgData[$w]);



            //criando uma nova imagem
            $pdf->Image($tempImg[$w], 10, 10, 100); // Ajuste posição/tamanho



            break;

        default:
            # code...
            break;
    }


    $w++;
}

//





// Output
$pdf->Output();


foreach ($tempPdfFile as $key => $value) {
    unlink($value);
}



foreach ($tempIMGFile as $key => $value) {
    unlink($value);
}
