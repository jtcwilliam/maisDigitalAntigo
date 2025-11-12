<?php









//combo Categorias da da pagina Habilitacao
if (isset($_POST['containner']) && $_POST['containner'] == 'comboServicosCategoria') {
    include_once '../classes/Categoria.php';

    $objCategoria = new Categoria();

    $dados =    $objCategoria->trazerCategorias();

    echo  '<option    >     </option>';

    foreach ($dados as $key => $value) {
        echo '<option     value=' . $value['idCategoria'] . '  >' .  $value['descricaoCategoria'] . '</option>';
    }
}





//combo serviços da pagina index (criado para trazer o link)
if (isset($_POST['containner']) && $_POST['containner'] == 'comboServicos') {
    include_once '../classes/servicos.php';
    $strings = preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"), explode(" ", "a A e E i I o O u U n N c C"), $_POST['dadosServico']);
    $strings;
    $objservico = new Servicos();
    $retornoTabelaServico = $objservico->servicosHabilitados($strings);


?>
    <table>
        <thead>
            <tr>
                <th width="400">Serviço</th>

                <th width="50"></th>
                <th width="50">Solicitar</th>
            </tr>
        </thead>
        <tbody style="font-weight: 300;">
            <?php
            foreach ($retornoTabelaServico as $key => $value) {
            ?>
                <tr>
                    <td><?= $value['nome_servico'] ?></td>
                    <td><a onclick="  $('#modalDuvidasCartas').foundation('open');"> Me ajude</a></td>
                    <td><a onclick="  $('#tudoCertoLink').show();  
                    $('#nomeDoServicoLabel').val( '<?= $value['nome_servico'] ?>' ) ;   
                    
                    $('#txtServicoSolicitar').val('<?= $value['id_carta_servico'] ?>' ) ;  
                    criarCaixaArquivo(<?= $value['id_carta_servico'] ?>) 
                    
                    "> Quero Solicitar</td>


                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}


//combo serviços (criado para trazer o id de cada serviço)
if (isset($_POST['containner']) && $_POST['containner'] == 'comboServicosDocumentos') {
    include_once '../classes/servicos.php';

    $objservico = new Servicos();

    $dados = $objservico->trazerServicosParaHabilitar();



    echo  '<option>     </option>';


    foreach ($dados as $key => $value) {

        $descricao = $value['nomeServico'];
        if (strlen($descricao) > 200) {

            $descricao = substr($descricao, 0, 200) . '...';
        }


        echo '<option value=' . $value['idCartaServico'] . '>' . $descricao . '</option>';
    }
}


if (isset($_POST['containner']) && $_POST['containner'] == 'comboDocumentos') {
    include_once '../classes/Documentos.php';

    $objservico = new Documentos();

    $dados = $objservico->trazerDocumentos();



    echo  '<option    >     </option>';


    foreach ($dados as $key => $value) {

        $descricao = $value['descricaoDoc'];
        if (strlen($descricao) > 200) {

            $descricao = substr($descricao, 0, 200) . '...';
        }


        echo '<option value=' . $value['idDoc'] . '  >' . $descricao . '</option>';
    }
}


if (isset($_POST['containner']) && $_POST['containner'] == 'comboTipoInscricao') {
    include_once '../classes/Documentos.php';

    $objservico = new Documentos();

    $dados = $objservico->trazerDocumentos(' where status = 9 ');



    echo  '<option    >     </option>';


    foreach ($dados as $key => $value) {

        $descricao = $value['descricao_doc'];
        if (strlen($descricao) > 200) {

            $descricao = substr($descricao, 0, 200) . '...';
        }


        echo '<option value=' . $value['id_doc'] . '  >' . $descricao . '</option>';
    }
}
