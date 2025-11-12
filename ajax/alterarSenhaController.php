<?php

include_once '../classes/Pessoa.php';

$objPessoa = new Pessoa();
 
$objPessoa->setSenha(md5($_POST['senha']));
 
$objPessoa->setid_pessoa($_POST['dwp']);
 
if($objPessoa->alterarSenha()==true){

     echo json_encode(array('retorno' => true));

}
