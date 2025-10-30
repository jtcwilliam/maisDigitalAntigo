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


$nomeArquivoSalvar = md5($_POST['idSolicitacao'].date("Y-m-d H:i:s"));




$file = file_get_contents($_FILES['file']['tmp_name']);



$arquivoTipo =  $_FILES['file']['type'];

$tipoDeArquivo = explode('/', $arquivoTipo);

$tipoArquivo = $tipoDeArquivo[count($tipoDeArquivo)-1];





move_uploaded_file($_FILES['file']['tmp_name'], '../files/'.$nomeArquivoSalvar.'.'.$tipoArquivo);

$idTipoDocumento = $_POST['idTipoDocumento'];


$objArquivo->setTipoArquivo($arquivoTipo);

$objArquivo->setNomeArquivo($nomeArquivo);

$objArquivo->setIdSolicitacao($_POST['idSolicitacao']);

$objArquivo->setStatusArquivo('1');
 

$objArquivo->setArquivo('files/'.$nomeArquivoSalvar.'.'.$tipoArquivo);

$objArquivo->setIdTipoDocumento($idTipoDocumento);

$objArquivo->setAssinadoDigital('0');

$carregarFinalizaUP = 1;

$dadosDoInsert = $objArquivo->inserirArquivos();

$arr = json_decode($dadosDoInsert, true);


if ($arr['retorno'] == 1) {



    echo json_encode(array('retorno' => true));
}

exit();
