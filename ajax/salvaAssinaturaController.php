<?php



include_once '../classes/Solicitacao.php';




$objSolicitacao = new Solicitacao(); 


if (isset($_POST['verificarAssinatura'])  &&  $_POST['verificarAssinatura']) {

    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);








    //    print_r($assinaturaAtiva[0]['statusSolicitacao']);

    if ($assinaturaAtiva[0]['statusSolicitacao'] == '10') {

        $retornoAssinatura = '<center><img style="" src="' . $assinaturaAtiva[0]['assinaturaSolicitacao']  . '" /></center>';

        echo json_encode(array('retorno' => true));
    }

    die();
}


if (isset($_POST['finalizaSolicitacao'])  &&  $_POST['finalizaSolicitacao']) {

    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);


?>

    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block;">
        <legend>
            <h4 id=""> </h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">



            <div class="small-12 large-10 cell">
                <label>Assunto da Solicitação
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['nome_servico'] ?>" />
                </label>
            </div>
            <div class="small-12 large-2 cell">
                <label>Status
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['descricao_status'] ?>" />
                </label>

            </div>




            <div class="small-12 large-12 cell">
                <label>Descrição da Sua Solicitação <i>(Campo Obrigatório)</i>
                    <textarea id='txtDescricao' rows="5" readonly style="width: 100%; background-color: white;">  <?= $assinaturaAtiva[0]['descricao_solicitacao'] ?> </textarea>
                </label>
            </div>



            <div class="small-12 large-3 cell">
                <label>Nome do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="nomeSolicitante" value="<?= $assinaturaAtiva[0]['nome_pessoa'] ?>" />
                </label>
            </div>
            <div class="small-12 large-3 cell">
                <label>CPF do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="cpfSolicitante" value="<?= $assinaturaAtiva[0]['doc_solicitacao_pessoal'] ?>" />
                </label>
            </div>

            <div class="small-12 large-4 cell">
                <label>Email do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="emailSolicitante" value="<?= $assinaturaAtiva[0]['email_usuario'] ?>" />
                </label>
            </div>



            <div class="small-12 large-2 cell">
                <label>Dia da Solicitação
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['dia_da_solicitacao'] ?>" />
                </label>

            </div>

            <div class="small-12 large-1 cell">
                <label>CEP:
                    <input type="text" readonly style="width: 100%; background-color: white;" id="txtCEP" value="<?= $assinaturaAtiva[0]['cep_solicitacao'] ?>" />
                </label>

            </div>

            <div class="small-12 large-4 cell">
                <label>Logradouro
                    <input type="text" id="txtRua" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['logradouro_sol'] ?>" />
                </label>

            </div>
            <div class="small-12 large-1 cell">
                <label>Nº
                    <input type="text" id="txtNUmero" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['numero_sol'] ?>" />
                </label>

            </div>
            <div class="small-12 large-2 cell">
                <label>Complemento
                    <input type="text" id="txtComplemento" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['complemento'] ?>" />
                </label>

            </div>

            <div class="small-12 large-2 cell">
                <label>Bairro
                    <input type="text" id="txtBairro" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['bairro'] ?>" />
                </label>

            </div>








            <div class="small-12 large-2 cell" id="boxInsc">
                <label><?= $assinaturaAtiva[0]['descricao_doc'] ?>

                    <input id="inscDocu" type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['documento_publico'] ?>" />

            </div>




    </fieldset>





<?php




    //echo $assinaturaAtiva[0]['assinatura_solicitacao'] ;

    echo   '<center><img style="" src="' . $assinaturaAtiva[0]['assinatura_solicitacao']  . '" /><br> <p   style="margin-top: -40px; font-size:1.5em">' . $assinaturaAtiva[0]['nome_pessoa']  . ' </p> </center>';





    die();
}





$objSolicitacao->setArquivo($_POST['assinatura']);
$objSolicitacao->setSolicitacao($_POST['idSolicitacao']);

 

if ($_POST['assinaturaTerceiro'] && $_POST['assinaturaTerceiro'] == '1') {
    if ($objSolicitacao->inserirAssinaturaSolicitacao(1) == true) {
        echo json_encode(array('retorno' => true));
    }
    die();
}


if ($objSolicitacao->inserirAssinaturaSolicitacao(0) == true) {
    echo json_encode(array('retorno' => true));
}
