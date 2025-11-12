<?php
/*
echo '<pre>';
print_r($_SESSION['usuariosLogados']);
echo '</pre>';
*/


?>


<div class="small-12 large-12 cell" style="padding: 30px;">

    <div class=" grid-x grid-padding-x">
        <div class="small-12 large-12 cell">



            <fieldset class="fieldset" id="aberturaSolicitacao">
                <legend>
                    <h3>Olá. Seja bem vindo ao + Digital</h3>
                </legend>



                <div class="small-12 large-12 cell">
                    <br>

                    <a class="button " target="_blank" style="font-weight: 300; width: 100%;" onclick=" $('#iniciosSolicitacao').show();   $('#aberturaSolicitacao').hide(); ">
                        Abrir uma nova Solicitação
                    </a>

                </div>



                <div class="small-12 large-12 cell">


                    <fieldset class="fieldset">
                        <legend>
                            <h4>Solicitações em Andamento</h4>
                        </legend>



                        <div id="solicitacaoStatusContainer" style="background-color: gray;">


                        </div>


                    </fieldset>

                </div>











            </fieldset>




            <!-- combo com a carta de serviço.. inicial  . -->


            <?php

            include_once 'comps/comboSelecaoServico.php';


            ?>



            <!-- area para fazer a solicitacao-->
            <fieldset class="fieldset" id="fieldSolicitacao">
                <legend>
                    <h4 id=""> </h4>
                </legend>

                <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">

                    <div class="small-12 large-2 cell">
                        <label>Nome do Solicitante
                            <input type="text" readonly style="width: 100%;" id="nomeSolicitante" value="<?= $_SESSION['usuariosLogados']['dados'][0]['nome_pessoa'] ?>" />
                        </label>
                    </div>
                    <div class="small-12 large-2 cell">
                        <label>CPF do Solicitante
                            <input type="text" readonly style="width: 100%;" id="cpfSolicitante" value="<?= $_SESSION['usuariosLogados']['cpfDoUsuario'] ?>" />
                        </label>
                    </div>

                    <div class="small-12 large-2 cell">
                        <label>Email do Solicitante
                            <input type="text" readonly style="width: 100%;" id="emailSolicitante" value="<?= $_SESSION['usuariosLogados']['dados'][0]['email_usuario'] ?>" />
                        </label>
                    </div>

                    <div class="small-12 large-2 cell">
                        <label>Dia da Solicitação
                            <input type="text" readonly style="width: 100%;" value="<?php echo date('d/m/Y'); ?>" />
                        </label>

                    </div>

                    <div class="small-12 large-2 cell">
                        <label> Representa outra pessoa?
                            <a class="button" onclick="$('#boxTerceiro').show(); $('#representaTerceiro').val(1)" style="width: 100%;   ">Sim!</a>
                        </label>

                    </div>

                    <div class="small-12 large-2 cell">
                        <label>&nbsp;
                            <a class="button" onclick="$('#boxTerceiro').hide(); $('#representaTerceiro').val(0)" style="width: 100%; background-color: #363636ff;">Não!</a>
                        </label>

                    </div>

                    <div class="small-12 large-12 cell" id="boxTerceiro">
                        <fieldset class="fieldset" style="background-color: #1779ba1c; border-radius: 15px;">
                            <h5><b>Dados do Terceiro</b></h5>

                            <div class=" grid-x  grid-padding-x">

                                <div class="small-12 large-4 cell">
                                    <label>Nome do Terceiro
                                        <input type="hidden" style="width: 100%;" id="representaTerceiro" />
                                        <input type="text" style="width: 100%;" id="nomeTerceiro" />
                                    </label>


                                </div>

                                <div class="small-12 large-3 cell">
                                    <label>CPF ou CNPJ
                                        <input type="text" style="width: 100%;" id="cpfTerceiro" />
                                    </label>


                                </div>

                                <div class="small-12 large-3 cell">
                                    <label>Email
                                        <input type="text" style="width: 100%;" id="emailTerceiro" />
                                    </label>


                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Telefone
                                        <input type="text" style="width: 100%;" id="telefoneTerceiro" />
                                    </label>


                                </div>


                                <div class="small-12 large-12 cell" style="padding-top: 10px;">
                                    <h6><b>Autorizo para todos os atos desse processo, os(as) senhores(as) </b></h6>

                                    <div class=" grid-x  grid-padding-x atuarPessoa" id="boxPessoas">

                                        <div class="small-12 large-3 cell">
                                            <label>Nome
                                                <input type="text" class="nomeAtuar">
                                            </label>


                                        </div>

                                        <div class="small-12 large-2 cell">
                                            <label>RG
                                                <input type="text" style="width: 100%;" class="rgAtuar" />
                                            </label>


                                        </div>

                                        <div class="small-12 large-3 cell">
                                            <label>Email
                                                <input type="text" style="width: 100%;" class="emailAtuar" />
                                            </label>


                                        </div>

                                        <div class="small-12 large-2 cell">
                                            <label>Celular
                                                <input type="text" style="width: 100%;" class="celularAtuar" />
                                            </label>


                                        </div>

                                        <div class="small-12 large-2 cell">
                                            <label>Adicionar outra Pessoa
                                                <a class="button" onclick="clonarClasse()" style="width: 100%;"> + </a>
                                            </label>


                                        </div>





                                    </div>

                                    <div id="containerClone">

                                    </div>

                                    </label>


                                </div>



                            </div>


                        </fieldset>


                    </div>


                    <div class="small-12 large-12 cell" id=" ">
                        <fieldset class="fieldset">
                            <legend>Informação da Solicitação</legend>

                            <div class=" grid-x  grid-padding-x">

                                <div class="small-12 large-2 cell">
                                    <label>CEP:
                                        <input type="text" id="txtCEP" onchange="chamaCEP($('#txtCEP').val())" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-3 cell">
                                    <label>Logradouro
                                        <input type="text" id="txtRua" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-1 cell">
                                    <label>Nº
                                        <input type="text" id="txtNUmero" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Complemento
                                        <input type="text" id="txtComplemento" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Bairro
                                        <input type="text" id="txtBairro" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Cidade / Estado
                                        <input type="text" id="txtCidade" style="width: 100%;" />
                                    </label>

                                </div>


                                <div class="small-12 large-1 cell" style="display: none;">
                                    <label>UF
                                        <input type="text" id="txtEstado" style="width: 100%;" />
                                    </label>

                                </div>


                                <div class="small-12 large-12 cell">
                                    <label>Assunto da Solicitação
                                        <input type="text" readonly style="width: 100%;" id="nomeDoServicoLabel" value="" />
                                    </label>
                                </div>

                                <div class="small-12 large-12 cell">
                                    <label>Descrição da Sua Solicitação <i>(Campo Obrigatório)</i>
                                        <textarea id='txtDescricao' rows="5" style="width: 100%;"></textarea>
                                    </label>
                                </div>

                                <div class="small-12 large-3 cell">
                                    <label>Escolha qual tipo de Inscrição

                                        <script>
                                            criaCombo('comboTipoInscricao');
                                        </script>
                                        <select id="comboTipoInscricao"
                                            onchange="trocaCampo($(this).val())" name="state" style="width: 100%; ">

                                        </select>
                                    </label>
                                </div>

                                <div class="small-12 large-2 cell" id="boxInsc">
                                    <label id="tipoInscricaoLbl">Inscrição Mobiliária </label>
                                    <input id="inscDocu" type="text" style="width: 100%;" />

                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Status da Solicitação
                                        <input type="text" readonly style="width: 100%;" value="Abertura" />
                                    </label>

                                </div>

                                <div class="small-12 large-5 cell">
                                    <label><br>
                                        <center><a class="button success" style="width: 100%;"
                                                onclick=" inserirSolicitacao('<?= $_SESSION['usuariosLogados']['dados'][0]['id_pessoa'] ?>');">Avançar para a documentação </a>
                                        </center>
                                    </label>
                                </div>
                            </div>
                        </fieldset>


            </fieldset>

            <!-- campo documentacao -->

            <fieldset class="fieldset" id="documentacao">
                <input type="text" id='idSolicitacaoHidden' />

                <legend>
                    <h4 id="">Documentação Necessária para Solicitação</h4>
                </legend>
                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-12 cell" id="arquivosInseriveis" style="width: 100%;">


                    </div>
                </div>

                <div class=" grid-x grid-padding-x" id="arquivosAnexosSucesso">
                    <div class="small-12 large-12 cell" style="width: 100%; padding-top: 30px;">
                        <center><a class="button success " onclick=" $('#envioAssinatura').show();  
                         verificarAssinatura($('#idSolicitacaoHidden').val())  ;    
                         qrCodeAssinatura('https:\/\/agendafacil.guarulhos.sp.gov.br\/maisDigital\/assinatura.php?idSolicitacao='+$('#idSolicitacaoHidden').val());
                          $('#documentacao').hide(); $('#fieldSolicitacao').hide();
                           $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)' );
                            $('#complemento').css('color', 'rgba(8, 124, 4, 0.66)' ); 
                            $('#docsEstagio').css('color', 'rgba(8, 124, 4, 0.66)' );" style="  width: 100%; font-size: 1.3em; border-radius: 10px; "> Clique aqui para fazer a assinatura da Solicitação</a></center>

                    </div>
                </div>
            </fieldset>


            <!-- fim campo documentacao -->


            <fieldset class="fieldset" id="envioAssinatura">


                <legend>
                    <h4 id="">Deite o Celular e escaneie o QRCode abaixo. Você irá assinar esta solicitação</h4>
                </legend>
                <br>

                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-12 cell" style="width: 100%;  ">



                        <div id="img" style="padding-top: 30px;"></div>
                        <br>
                        <center> <a class="button" onclick="finalizarSolicitacao($('#idSolicitacaoHidden').val());

                         $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)' );
                            $('#complemento').css('color', 'rgba(8, 124, 4, 0.66)' ); 
                            $('#docsEstagio').css('color', 'rgba(8, 124, 4, 0.66)' );
                            $('#finalizacao').css('color', 'rgba(8, 124, 4, 0.66)' );
                        $('#solicitacaoEnviada').css('color', 'rgba(8, 124, 4, 0.66)' );" style="width: 60%;">Se você ja assinou, clique aqui!</a>
                        </center>




                    </div>
                </div>


            </fieldset>

            <fieldset class="fieldset" id="finalizacaoSolicitacao">


                <legend>
                    <h4 id="">Sua Solicitação foi cadastrada com sucesso</h4>

                </legend>
                <br>
                <div class=" grid-x grid-padding-x" style="display: block; margin-top: -60px;">

                </div>

                <div class=" grid-x grid-padding-x" style="display: block; margin-top: -60px;">
                    <div class="small-12 large-12 cell" style="width: 100%;  " id="solicitacaoFinalizada">




                    </div>

                    <div class="small-12 large-12 cell" style="width: 100%;  " id="solicitacaoFinalizada">




                    </div>


                </div>


            </fieldset>



            <fieldset class="fieldset" id="estagios">

                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-3 cell">


                    </div>


                    <center>
                        <div class=" grid-x grid-padding-x">
                            <div class="small-12 large-2 cell" id="escolha"> <b>1</b><br>
                                <i>Escolha da Solicitação</i>
                            </div>

                            <div class="small-12 large-2 cell" id="complemento" style="color: #999;"> <b>2</b><br>
                                <i>Complemento da Solicitação</i>
                            </div>

                            <div class="small-12 large-2 cell" id="docsEstagio" style="color: #999;"> <b>3</b><br>
                                <i id="docsEstagio">Documentação Necessária</i>
                            </div>

                            <div class="small-12 large-2 cell" id="finalizacao" style="color: #999;"> <b>4</b><br>
                                <i>Assinatura</i>
                            </div>

                            <div class="small-12 large-2 cell" id="solicitacaoEnviada" style="color: #999;"> <b>5</b><br>
                                <i>Solicitação Enviada</i>
                            </div>
                        </div>
                    </center>


                    <div class="small-12 large-12 cell" id="botaoRetorno">
                        <center><a class="button " style="width: 40%; margin-top: 40px;  " onclick="window.location.reload()">Voltar para a tela inicial das Solicitações</a></center>
                    </div>
                </div>

                <div class="small-12 large-3 cell">


                </div>
        </div>






        </fieldset>








    </div>




</div>
</div>

<script>
    $('#linkHelpServico').hide();
    $('#iniciosSolicitacao').hide();
    $('#fieldSolicitacao').hide();
    $('#boxTerceiro').hide();
    $('#documentacao').hide();
    $('.mensagemB').hide();
    $('#arquivosAnexosSucesso').hide();
    $('#envioAssinatura').hide();
    $('#finalizacaoSolicitacao').hide();
    $('#txtCEP').mask("00000-000");

    $('#botaoRetorno').hide();
    $('#tudoCertoLink').hide();



    consultarSolicitacaoStatus('10, 11');




    function clonarClasse() {
        var elementoParaClonar = $('#boxPessoas');

        // 2. Clona o elemento, incluindo seus descendentes e nós de texto (cópia profunda)
        var elementoClonado = elementoParaClonar.clone(false, false); // O 'true, true' garante a cópia de eventos e descendentes

        // 3. Adiciona o elemento clonado ao final da div com a classe "container"
        elementoClonado.appendTo('#containerClone');
    }


    function trocaCampo(valor) {

        if (valor === '35') {
            $('#boxInsc').show();

            $('#tipoInscricaoLbl').html('IPTU');

            $('#inscDocu').mask("00.0000.0000.0000");

        } else if (valor === '36') {

            $('#boxInsc').show();
            $('#tipoInscricaoLbl').html('Inscrição Mobiliária');


            $('#inscDocu').mask("000.000.000.000");

        } else if (valor === '37') {

            $('#boxInsc').show();
            $('#tipoInscricaoLbl').html('Cadastro');


            $('#inscDocu').mask("0000000000000000");

        } else {
            $('#tipoInscricaoLbl').html('Outros');


            $('#inscDocu').mask("000000000000000    00000000");

        }

        return true;

    }

    function inserirSolicitacao(solicitante) {
        $('.atuarPessoa').each(function() {
            emailAtuar = $(this).find('.emailAtuar').val();
            nomeAtuar = $(this).find('.nomeAtuar').val();
            celularAtuar = $(this).find('.celularAtuar').val();

            pessoa = `Nome: ${nomeAtuar}. Email ${emailAtuar}. Celular  ${celularAtuar } `;

            console.log(pessoa);

        })

        var formData = {
            representaTerceiro: $('#representaTerceiro').val(),
            nomeTerceiro: $('#nomeTerceiro').val(),
            cpfTerceiro: $('#cpfTerceiro').val(),
            emailTerceiro: $('#emailTerceiro').val(),
            telefoneTerceiro: $('#telefoneTerceiro').val(),

            //alterar o nome para idServicos
            assuntoSolicitacao: $('#txtServicoSolicitar').val(),
            descricao: $('#txtDescricao').val(),
            documentoPublico: $('#inscDocu').val(),
            comboTipoInscricao: $('#comboTipoInscricao').val(),
            idUsuario: solicitante,
            statusSolicitacao: 9,
            inserirSolicitacao: 0,
            cpfSolicitante: $('#cpfSolicitante').val(),
            txtCEP: $('#txtCEP').val(),
            txtRua: $('#txtRua').val(),
            txtNUmero: $('#txtNUmero').val(),
            txtComplemento: $('#txtComplemento').val(),
            txtBairro: $('#txtBairro').val()


        };
        $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoController.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data) {

                console.log(data);


                if (data.retorno == true) {
                    $('#idSolicitacaoHidden').val(data.idSolicitacaoHidden);
                    $('#documentacao').show();
                    $('#fieldSolicitacao').hide();
                    $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)');
                    $('#complemento').css('color', 'rgba(8, 124, 4, 0.66)');
                    $('#docsEstagio').css('color', 'rgba(0, 0, 0, 1)');
                }
            });
    }

    function qrCodeAssinatura(link) {

        var formData = {
            link

        };
        $.ajax({
                type: 'POST',
                url: 'qrcode.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {

                console.log(data);


                $('#img').html(data);


            });
    }


    function verificarAssinatura(idSolicitacao) {

        var formData = {
            idSolicitacao,
            verificarAssinatura: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/salvaAssinaturaController.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data) {

                if (data.retorno == 10) {

                    $('#envioAssinatura').hide();



                }

            });
    }







    //solicitacaoStatusContainer

    function consultarSolicitacaoStatus(idStatus) {

        var formData = {
            idStatus,

            trazerSolicitacaoStatus: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                $('#solicitacaoStatusContainer').html(data);
            });
    }



    function finalizarSolicitacao(idSolicitacao) {

        var formData = {
            idSolicitacao,

            finalizaSolicitacao: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/salvaAssinaturaController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {

                $('#envioAssinatura').hide();

                $('#finalizacaoSolicitacao').show();

                $('#botaoRetorno').show();

                $('#solicitacaoFinalizada').html(data);

            });
    }



    function exibirSolicitacao(idSolicitacao) {

        $('#exibirSolicitacoes').foundation('open');

        var formData = {
            idSolicitacao,

            finalizaSolicitacao: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/salvaAssinaturaController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {

                $('#envioAssinatura').hide();



                $('#exibirSolicitacaoModal').html(data);

            });
    }
</script>