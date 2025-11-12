<?php


$nome = $_POST['nomeUsuario'];
$nome = str_replace(' ', '', $nome);
if (strlen($nome) <= 2) {
    echo json_encode(array('retorno' => 'nomeErrado'));
} else {





    include_once '../classes/Pessoa.php';

    $objPessoaMovimentar = new Pessoa();

    //esse script apenas grava a pessoa


    $prefixo = $_POST['cpf'];

    $prefixo = substr($prefixo, 0, 3);




    
    if ($_POST['valida_tipo_cadastro'] == '0') {


        $objPessoaMovimentar->setemail_usuario(null);
        $objPessoaMovimentar->setSenha(null);
    } else {
        
        $objPessoaMovimentar->setemail_usuario($_POST['emailAgendamento']);
        $objPessoaMovimentar->setSenha(md5($_POST['senhaAgendamento']));
    }

    



    $objPessoaMovimentar->setnome_pessoa($_POST['nomeUsuario']);
    $objPessoaMovimentar->settipo_pessoa('1');
    $objPessoaMovimentar->setstatus_pessoa('1');
    $objPessoaMovimentar->setdocumento_pessoa($_POST['cpf']);
    $objPessoaMovimentar->setprefixo_doc($prefixo);
    $objPessoaMovimentar->setvalida_tipo_cadastro($_POST['valida_tipo_cadastro']);

    $objPessoaMovimentar->setConfirmaTermo($_POST['confirmaTermo']);



 
    if ($objPessoaMovimentar->inserirPessoasAgendamento()) {
        echo json_encode(array('retorno' => true));
    }

   
 
}
