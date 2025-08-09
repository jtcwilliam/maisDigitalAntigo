<?php

include_once '../classes/Solicitacao.php';
$objSolicitacao = new Solicitacao();

if (isset($_POST['ajudaAtendente'])) {



    $manualAtendente = $objSolicitacao->pesquisaManualAtendente($_POST['solicitacao']);
?>

    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">
            <h3><?= ltrim($manualAtendente[0]['descricaoCarta']); ?></h3>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">

            <h6> <a href="<?= $manualAtendente[0]['linkCarta']  ?>" target="_blank"> <b>Clique para saber mais sobre este procedimento na Carta de Serviço Oficial </b> </a></h6>
        </div>
    </div>



    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">
            <fieldset class="fieldset">
                <legend><b>Os documentos listados abaixo são necessários para dar prosseguimento</b></legend>
                <ul>
                    <?php
                    foreach ($manualAtendente as $key => $value) {
                        echo '<li>' . $value['descricaoDoc'] . '</li>';
                    }
                    ?>
                </ul>
            </fieldset>

            <fieldset class="fieldset">
                <legend><b>Informações restritas para o atendente</b></legend>
                <ul>
                    <?php
                        echo $manualAtendente[0]['infoAtendente'];
                    ?>
                </ul>
            </fieldset>

        </div>
    </div>





<?php










}
