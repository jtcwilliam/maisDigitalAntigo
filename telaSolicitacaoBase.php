<?php
/*
echo '<pre>';
print_r($_SESSION['usuariosLogados']);
echo '</pre>';
*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    
    , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div id='solicitacaoFinalizada' ></div>    
        
</body>

<script>

    exibirSolicitacao(62)

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
        exibirSolicitacao(idSolicitacao)

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