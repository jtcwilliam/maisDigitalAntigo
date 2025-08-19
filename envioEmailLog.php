<?php


ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



include './classes/Envio.php';
include './classes/Solicitacao.php';
include './classes/Log.php';


$objLog = new Log();
$objEnvio = new Envio();
$objSolicitacao = new Solicitacao();



ob_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body style="font-family: Arial, Helvetica, sans-serif;">
    <center>

        <?php

        $dadosSolicitacao = $objSolicitacao->consultarSolicitacaoRelatorio(110);



        print_r($dadosSolicitacao);



        $dadosLog = $objLog->exibirLogs(111, 1);

        echo '<pre>';
        print_r($dadosLog);
        echo '</pre>';


        ?>
        <h2>Olá Somos da Equipe Mais Digital da Prefeitura de Guarulhos </h2>

        <p>Verificamos algumas inconsistencias na Solicitação da <b> <?= $dadosSolicitacao[0]['descricaoCarta']   ?></b> que você realizou! <br>Não se preocupe, nós vamos te dizer o que aconteceu e os arquivos que você precisa enviar<br>
            <b>Lembre-se: </b> A solicitação ficará em suspensão enquanto você não resolver essas inconsistências

        </p>




        <br>Clique no link que enviamos neste email para fazer a
        alteração adequada e prosseguirmos para a conclusão de sua solicitação<br> <b>Observação:</b> Está solicitação permanecerá
        sem prosseguimento, até que você faça esta correção.
        </p>




        <a style="color: green; text-decoration: none; font-style: italic;"
            href="https://agendafacil.guarulhos.sp.gov.br//testeDigitalPlus_agosto/carregarArquivoSolicitacao.php?idSolicitacao=111 " target="_blank">
            <h2>Clique aqui para enviar os Arquivos Necessários </h2>
        </a>
        <br>

        <h4> Estamos á Disposição!<br>

            <b>Equipe Mais Digital</b>
            <h2> Prefeitura de Guarulhos</h2>
        </h4>





    </center>
</body>

</html>
<?php
$dados = ob_get_contents();
ob_end_clean();


echo $dados;


/*

$objEnvio->setDestinatario($dadosSolicitacao[0]['emailUsuario']);
$objEnvio->setAssunto('Alteração de Arquivo na sua solicitação');
$objEnvio->setConteudo($dados);

if ($objEnvio->envioEmail()) {

    echo json_encode(array('retorno' => true));
}

*/




exit();






?>