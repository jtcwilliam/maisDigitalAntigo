<?php

include_once '../classes/arquivo.php';


$objArquivo = new Arquivo();


$tipo = $_FILES['file']['type'];

$nomeArquivo = $_POST['nomeArquivo'];



include_once '../classes/Sanitizar.php';

$nomeArquivoSize =  $_POST['nomeArquivo'];
if (strlen($nomeArquivoSize) >= 180) {
    $nomeArquivo = substr($nomeArquivoSize, 0, 180);
}


$nomeArquivo =  $nomeArquivo;



$file = file_get_contents($_FILES['file']['tmp_name']);

$arquivoTipo =  $_FILES['file']['type'];

$idTipoDocumento = $_POST['idTipoDocumento'];


$objArquivo->setTipoArquivo($arquivoTipo);

$objArquivo->setNomeArquivo($nomeArquivo);

$objArquivo->setIdSolicitacao($_POST['idSolicitacao']);

$objArquivo->setStatusArquivo('1');

$objArquivo->setArquivo($file);

$objArquivo->setIdTipoDocumento($idTipoDocumento);

$carregarFinalizaUP = 1;

$dadosDoInsert = $objArquivo->inserirArquivos();

$arr = json_decode($dadosDoInsert, true);


if ($arr['retorno'] == 1) {



    echo json_encode(array('retorno' => true));
}

exit();
