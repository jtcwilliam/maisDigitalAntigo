<?php



include '../classes/servicos.php';
include '../classes/Documentos.php';

$objServicos = new Servicos();
$objDocumentos = new Documentos();


$documentosInserir = $_POST['comboDocumentos'];

$docs = count($documentosInserir);



$objServicos->setServicoHabilitado(1);
$objServicos->setInfoAtendente($_POST['infoAtendimentos']);
$objServicos->setIdCartaServico($_POST['comboServicos']);
$objServicos->setCategoria($_POST['comboCategoria']);

$tags = $_POST['tagsAtendimento'];

$strings = preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"    ), explode(" ", "a A e E i I o O u U n N c C"), $tags);

$objServicos->setTags($strings);

$i = 0;

  


if ($objServicos->habilitarServicos()) {



    foreach ($documentosInserir as $key => $value) {

        $objDocumentos->setIdServico($_POST['comboServicos']);

        $objDocumentos->setIdDocumento($value);
        $objDocumentos->setStatus('1');

        if ($objDocumentos->inserirServicoDocumento()) {
            $i++;
        }
    }
}



if ($i == $docs) {
    header("Location: ../habilitarServicos.php?servico=" . $_POST['comboServicos'] . "&retorno=true");
    die();
}
