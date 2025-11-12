<?php

include_once '../classes/Pessoa.php';

$objPessoaMovimentar = new Pessoa();

//esse script apenas grava a pessoa



require_once '../classes/LDAP.class.php';

$ldap = new LDAP();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$selectUnidade = $_POST['selectUnidade'];






$usuario = $ldap->logar($usuario, $senha);





if (isset($usuario['count'])  && $usuario['count'] == 1) {


$prefixo = $_POST['cpf'];

$prefixo = substr($prefixo, 0, 3);


    $objPessoaMovimentar->setnome_pessoa($_POST['nomeUsuario']);
    $objPessoaMovimentar->settipo_pessoa('3');
    $objPessoaMovimentar->setstatus_pessoa('1');
    $objPessoaMovimentar->setdocumento_pessoa($_POST['cpf']);
    $objPessoaMovimentar->setemail_usuario($_POST['usuario']);
    $objPessoaMovimentar->setUnidade($selectUnidade);
    $objPessoaMovimentar->setprefixo_doc($prefixo);




    if ($objPessoaMovimentar->inserirFuncionarioPrefs()) {
        echo json_encode(array('retorno' => true));
    }
} else {

    echo json_encode(array('retorno' => false));
}

exit();
