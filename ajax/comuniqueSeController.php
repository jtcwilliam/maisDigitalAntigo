<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



include '../classes/Envio.php';
include '../classes/Solicitacao.php';
include '../classes/arquivo.php';
include '../classes/Documentos.php';
include '../classes/Log.php';


$objEnvio = new Envio();
$objSolicitacao = new Solicitacao();
$objArquivo  = new Arquivo();
$objLog = new Log();
$objDocumentos = new Documentos();


if (isset($_POST['acaoComuniqueSE']) &&  $_POST['acaoComuniqueSE'] == 'solicitarArquivo') {

    $tipoDocumento = $objDocumentos->trazerDocumentos(' where idDoc=' . $_POST['codigoId']);

    $objArquivo->setTipoArquivo('Indefinido');

    $objArquivo->setNomeArquivo($tipoDocumento[0]['descricaoDoc']);

    $objArquivo->setIdSolicitacao($_POST['solicitacao']);

    $objArquivo->setStatusArquivo('12');

    $objArquivo->setArquivo('Arquivo vazio');

    $objArquivo->setIdTipoDocumento($tipoDocumento[0]['idDoc']);
    $objArquivo->setAssinadoDigital('0');

    $carregarFinalizaUP = 1;




    if ($dadosDoInsert = $objArquivo->inserirArquivos()) {

        if (!session_start()) {
            session_start();
        }



        $arr = json_decode($dadosDoInsert, true);


        
        //retorno para pegar o ultimoID
        $idArquivoParaLog =   $arr['ultimoID'][0]['LAST_INSERT_ID()'];



        $usuarioLog = $_SESSION['usuarioLogado']['dados'][0]['nome'];
        $nomeLog = 'Solicitamos o Envio do Arquivo ' . $tipoDocumento[0]['descricaoDoc'];
        $textoLog = $_POST['mensagemComuniqueArquivo'];
        $statusLog = '12';
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dataLog = date('Y-m-d H:i:s');


        $objLog->setNomePessoaLog($usuarioLog);
        $objLog->setNomeLog($nomeLog);
        $objLog->setTextoLog($textoLog);
        $objLog->setStatusLog($statusLog);
        $objLog->setDataLog($dataLog);
        $objLog->setTipoPessoaLog($_SESSION['usuarioLogado']['dados'][0]['tipoPessoa']);
        $objLog->setSolicitacao($_POST['solicitacao']);
        $objLog->setIdArquivo($idArquivoParaLog);

        if ($objLog->inserirLog()) {
               echo json_encode(array('retorno' => true));
        }
    }
}



if (isset($_POST['acaoComuniqueSE']) &&  $_POST['acaoComuniqueSE'] == 'alterarArquivo') {

    $objArquivo->setIdArquivo($_POST['codigoId']);
    if ($objArquivo->apagarArquivo()) {

        if (!session_start()) {
            session_start();
        }

        //solicta dados do arquivo para gravar  no log
        $dadosArquivo = $objArquivo->dadosArquivoSolicitante($_POST['codigoId']);

        $usuarioLog = $_SESSION['usuarioLogado']['dados'][0]['nome'];
        $nomeLog = 'Alteração do Arquivo' . $dadosArquivo[0]['nomeArquivo'];
        $textoLog = $_POST['mensagemComuniqueArquivo'];
        $statusLog = '12';

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dataLog = date('Y-m-d H:i:s');


        $objLog->setNomePessoaLog($usuarioLog);
        $objLog->setNomeLog($nomeLog);
        $objLog->setTextoLog($textoLog);
        $objLog->setStatusLog($statusLog);
        $objLog->setDataLog($dataLog);
        $objLog->setTipoPessoaLog($_SESSION['usuarioLogado']['dados'][0]['tipoPessoa']);
        $objLog->setSolicitacao($_POST['solicitacao']);

        if ($objLog->inserirLog()) {
            echo json_encode(array('retorno' => true));
        }






        //criar na classe log o metodo que insere o log aqui, que vem dessa consulta de dados ai, mais o id da ação do log
        // e a mensagem do comunique-se
        //criar um status de comunique-se e arquivo pendente de atualização pelo cidadão
        //terá um botão na tabela com arquivos, com a informação (atualizar comunique-se)
        //nessa hora ele roda essa tabela e verifica quais estão com esse status


        //quando o cidadão enviar o arquivo para a tabela arquivos, atualiza aqui para status ativo (1)
        //ou seja, grava o arquivo lá, atualiza aqui...






        exit();
    }




    exit();
}


if(isset($_POST['enviarEmail'])){

   

}
