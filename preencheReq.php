<?php

if (session_start()) {
    /*echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    */
}


?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php


include_once 'includes/head.php';



?>

<body style="background-image: url('imgs/fundoSistema.png') ;         background-size: cover " id="telaMaior">




    <!--container com todos os elementros para login e cadastro -->
    <div class="grid-x grid-padding-x" id="containerCadastro" style="height: 70vh;  ">
        <div class="auto cell">

        </div>



        <div class="small-12 large-6 cell" style="  padding-left: 10px; padding-right: 10px ;height: 150vh; background-color:rgb(216, 216, 219);">

            <div class="grid-container">



                <div class="grid-x grid-padding-x" id="imagemLogo">

                    <div class="small-`12 cell large-9">

                        <input type="text" style="display: none;" id="idRequerimento" value="<?= $_GET['idRequerimento'] ?>" />
                        <br>
                        <center><img src="imgs/gestaoPNG.png" style="width: 50%" /></center>
                    </div>
                </div>





                <div id="dadosPessoais">

                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <label>Nome
                                <input type="text" placeholder="Digite seu nome" id="txtNome" />
                            </label>

                        </div>
                    </div>


                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <label>CPF / CNPJ
                                <input type="text" class="cpf" id="cpf" onkeydown="mudarMascara(this.value)" placeholder="Digite seu CPF ou CNPJ" />
                            </label>

                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <label>Telefone
                                <input type="text" placeholder="Digite seu telefone" id="txtTel" />
                            </label>

                        </div>
                    </div>


                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <label>Email
                                <input type="text" placeholder="Digite seu Email" id="txtEmail" />
                            </label>

                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <a class="button " style="width: 100%;" onclick="$('#dadosPessoais').hide();  $('#endereco').show() ">Clique aqui para informar o Endereço</a>
                        </div>
                    </div>

                </div>


                <div id="endereco" style="display: none;">
                    <div class="grid-x grid-padding-x">
                        <div class="small-4   cell">
                            <label>CEP:
                                <input type="text" id="txtCEP" onchange="chamaCEP($('#txtCEP').val())" style="width: 100%;" />
                            </label>

                        </div>

                        <div class="small-8  cell">
                            <label>Bairro
                                <input type="text" id="txtBairro" class="enderecosCEP" readonly style="width: 100%;" />
                            </label>

                        </div>

                        <div class="small-12   cell">
                            <label>Logradouro
                                <input type="text" id="txtRua" class="enderecosCEP" readonly style="width: 100%;" />
                            </label>

                        </div>
                        <div class="small-4  cell">
                            <label>Nº
                                <input type="text" id="txtNUmero" style="width: 100%;" />
                            </label>

                        </div>
                        <div class="small-8   cell">
                            <label>Complemento
                                <input type="text" id="txtComplemento" style="width: 100%;" />
                            </label>

                        </div>



                        <div class="small-10   cell">
                            <label>Cidade
                                <input type="text" id="txtCidade" class="enderecosCEP" readonly style="width: 100%;" />
                            </label>

                        </div>


                        <div class="small-2  cell">
                            <label>UF
                                <input type="text" id="txtEstado" class="enderecosCEP" readonly style="width: 100%;" />
                            </label>

                        </div>

                        <div class="small-12 cell ">
                            <a class="button " style="width: 100%;" onclick="$('#dadosPessoais').hide();  $('#endereco').hide(); $('#addResponsavel').show()  ">Clique aqui para escrever sua solicitação</a>
                        </div>
                    </div>



                </div>


                <div id="addResponsavel">
                    <div class="small-12 large-12 cell" style="padding-top: 10px;">
                        <h6><b>Autorizo para todos os atos desse processo, os(as) senhores(as) </b></h6>

                        <div class=" grid-x  grid-padding-x atuarPessoa" id="boxPessoas">

                            <div class="small-12 large-12 cell">
                                <label>Nome
                                    <input type="text" class="nomeAtuar">
                                </label>


                            </div>





                            <div class="small-12 large-8 cell">
                                <label>Email
                                    <input type="text" style="width: 100%;" class="emailAtuar" />
                                </label>


                            </div>

                            <div class="small-12 large-4 cell">
                                <label>RG
                                    <input type="text" style="width: 100%;" class="rgAtuar" />
                                </label>


                            </div>

                            <div class="small-12 large-5 cell">
                                <label>Celular
                                    <input type="text" style="width: 100%;" class="celularAtuar" />
                                </label>


                            </div>



                            <div class="small-12 large-7 cell">
                                <label>&nbsp; <br>
                                    <a class="button" onclick="clonarClasse()" style="width: 100%; background-color: green;"> Adicionar outra Pessoa </a>
                                </label>


                            </div>





                        </div>

                        <div id="containerClone">

                        </div>

                        </label>


                        <div class="small-12 cell ">
                            <a class="button " style="width: 100%;" onclick="$('#dadosPessoais').hide();  $('#endereco').hide(); $('#addResponsavel').hide(); $('#solicitacao').show()  ">Clique aqui para escrever sua solicitação</a>
                        </div>

                    </div>




                </div>



                <div id="solicitacao">
                    <div class="grid-x grid-padding-x">
                        <div class="small-12   cell">
                            <label>Inscrição Mobiliária / Imobiliária (Não Obrigatório)
                                <input type="text" id="txtInscricao" style="width: 100%;" placeholder="Informação Opicional" />
                            </label>

                        </div>

                        <div class="small-12   cell">
                            <label>Venho Respeitosamente solicitar o que segue
                                <textarea rows="15" id="txtSolicitacao" style="width: 100%;"></textarea>
                            </label>

                        </div>



                        <div class="small-12 cell ">
                            <a class="button " style="width: 100%;" id="button"
                                onclick=" $('#imagemLogo').hide()  ;rotate(this)  ;$('#solicitacao').hide()  ;$('#assinatura').show() ">Clique aqui para assinar o Requerimento</a>
                        </div>

                    </div>
                </div>

                <div id="assinatura">
                    <div class="grid-x grid-padding-x">
                        <div class="small-12   cell">
                            <Br>





                            <div id="colherAssinatura">
                                <label>Assinar o Documento

                                    <canvas id="signatureCanvas" width="700" height="150" style="background-color: white;"></canvas>



                                    <div class="buttons">

                                        <div class="grid-x grid-padding-x">
                                            <div class="small-6   cell">
                                                <button class="button" style="background-color: rgba(181, 115, 0, 1); width: 100%; border-radius: 10px; ; color: white;" onclick="clearCanvas()">Limpar</button>
                                            </div>

                                            <div class="small-6   cell">

                                                <button class="button" style="background-color: rgba(27, 127, 4, 1);  width: 100%; ;border-radius: 10px; color: white;" onclick="saveSignature()">Salvar</button>

                                            </div>

                                        </div>


                                        <img id="savedImage" style="display: none;" alt="Assinatura aparecerá aqui" />



                                        <button type="submit" style="display: none;" onclick="inserirAssinaturaDoUsuario()">Enviar Imagem</button>

                                        <div id="mostraRodarImagem">

                                            <button onclick="rotate(this)" id="button" style="width: 100%; ">

                                            </button>
                                            <button onclick="screen.orientation.unlock()" style="display: none;">
                                                Unlock
                                            </button>
                                        </div>

                                    </div>






                                </label>

                            </div>
                        </div>



                        <?php

                        include_once 'includes/footer.php';

                        ?>
                    </div>

                </div>

                <div id="msgConfirmacao">
                    <div class="grid-x grid-padding-x">
                        <div class="small-12   cell">
                            <h3>
                                <center>
                                    Ola <span id="noticiaSucesso"></span>. Tudo Bem? <br>
                                    Seu requerimento foi criado com sucesso e já esta disponibilizado para seu atendimento.
                                    Avise ao Atendente por favor!

                                    <br>
                                    <img src="imgs/gestaoPNG.png" style="width: 50%" />
                                </center>
                            </h3>
                        </div>
                    </div>
                </div>







                <script>
                    $('#txtTel').mask("(00) 00000-0000");
                    $('#txtTel').mask("(00) 00000-0000");
                    $('#txtCEP').mask('00000-000');


                    function clonarClasse() {
                        var elementoParaClonar = $('#boxPessoas');

                        // 2. Clona o elemento, incluindo seus descendentes e nós de texto (cópia profunda)
                        var elementoClonado = elementoParaClonar.clone(false, false); // O 'true, true' garante a cópia de eventos e descendentes

                        // 3. Adiciona o elemento clonado ao final da div com a classe "container"
                        elementoClonado.appendTo('#containerClone');
                    }



                    $(document).ready(function() {


                        $('#infoSucesso').hide();
                        $('#colherAssinatura').hide()

                        $('#dadosPessoais').show();
                        $('#endereco').hide();
                        $('#msgConfirmacao').hide();
                        $('#addResponsavel').hide();
                        $('#solicitacao').hide();
                        $('#assinatura').hide();


                        var browserName = '';

                        const userAgent = window.navigator.userAgent;

                        if (userAgent.indexOf("Chrome") > -1) {
                            browserName = "Chrome";
                        } else if (userAgent.indexOf("Firefox") > -1) {
                            browserName = "Firefox";
                        } else if (userAgent.indexOf("Safari") > -1) {
                            browserName = "Safari";
                        } else if (userAgent.indexOf("MSIE") > -1 || userAgent.indexOf("Trident") > -1) {
                            browserName = "Internet Explorer";
                        } else if (userAgent.indexOf("Edge") > -1) {
                            browserName = "Edge";
                        } else {
                            browserName = "Desconhecido";
                        }

                        if (browserName == 'Safari') {

                            $('#mostraRodarImagem').html('<img src="imgs/rotatePhone.gif" /><br>Por favor, vire o celular para a posição horizontal!');

                            screen.orientation.addEventListener('change', function() {

                                if (window.innerWidth < window.innerHeight) {
                                    orientation = 90; // Paisagem

                                    $('#mostraRodarImagem').hide();
                                    $('#colherAssinatura').show();
                                }

                                if (window.innerWidth > window.innerHeight) {
                                    orientation = 90; // Paisagem

                                    $('#mostraRodarImagem').hide();
                                    $('#colherAssinatura').show();
                                }


                            });
                        }
                    })



                    function pegarAss() {

                        var assinatura = $("#savedImage").attr("src");
                    }



                    function updateLockButton() {
                        const lockButton = document.getElementById("button");
                        const newOrientation = getOppositeOrientation();
                        lockButton.textContent = `Clique aqui e faça a mesma assinatura do seu documento pessoal`;

                    }

                    function getOppositeOrientation() {
                        return screen
                            .orientation
                            .type
                            .startsWith("portrait") ? "landscape" : "portrait";
                    }

                    async function rotate(lockButton) {

                        $('#colherAssinatura').show();
                        $('#button').hide();
                        if (!document.fullscreenElement) {
                            await document.documentElement.requestFullscreen();
                        }
                        const newOrientation = getOppositeOrientation();
                        await screen.orientation.lock(newOrientation);
                        updateLockButton(lockButton);



                    }

                    screen.orientation.addEventListener("change", updateLockButton);

                    window.addEventListener("load", updateLockButton);



                    function inserirAssinaturaDoUsuario() {


                        var pessoa = '';

                        $('.atuarPessoa').each(function() {

                            emailAtuar = $(this).find('.emailAtuar').val();
                            nomeAtuar = $(this).find('.nomeAtuar').val();
                            celularAtuar = $(this).find('.celularAtuar').val();


                            pessoa += `<br><b>Nome:</b> ${nomeAtuar}. <b>Email:</b> ${emailAtuar}. <b>Celular:</b>  ${celularAtuar }`;




                        })




                        var assinatura = $("#savedImage").attr("src");

                        var formData = {
                            assinatura,
                            pessoa,
                            txtNome: $('#txtNome').val(),
                            cpf: $('#cpf').val(),
                            txtTel: $('#txtTel').val(),
                            txtEmail: $('#txtEmail').val(),
                            txtCEP: $('#txtCEP').val(),
                            txtRua: $('#txtRua').val(),
                            txtNUmero: $('#txtNUmero').val(),
                            txtComplemento: $('#txtComplemento').val(),
                            txtCidade: $('#txtCidade').val(),
                            txtSolicitacao: $('#txtSolicitacao').val(),
                            txtBairro: $('#txtBairro').val(),
                            idRequerimento: $('#idRequerimento').val()
                        };
                        var condicao;
                        $.ajax({
                                type: 'POST',
                                url: 'ajax/preencheReqController.php',
                                data: formData,
                                dataType: 'json',
                                encode: true
                            })
                            .done(function(data) {
                                console.log(data);

                                if (data.retorno == true) {
                                    $('#colherAssinatura').hide();
                                    $('#noticiaSucesso').html($('#txtNome').val());
                                    $('#msgConfirmacao').show();

                                }
                            });

                        event.preventDefault();
                    }





                    const canvas = document.getElementById('signatureCanvas');
                    const ctx = canvas.getContext('2d');

                    let drawing = false;

                    ctx.strokeStyle = '#000';
                    ctx.lineWidth = 2;
                    ctx.lineCap = 'round';

                    function getCoords(e) {
                        const rect = canvas.getBoundingClientRect();
                        if (e.touches && e.touches.length > 0) {
                            return {
                                x: e.touches[0].clientX - rect.left,
                                y: e.touches[0].clientY - rect.top
                            };
                        } else {
                            return {
                                x: e.clientX - rect.left,
                                y: e.clientY - rect.top
                            };
                        }
                    }

                    function startDrawing(e) {
                        const {
                            x,
                            y
                        } = getCoords(e);
                        drawing = true;
                        ctx.beginPath();
                        ctx.moveTo(x, y);
                        e.preventDefault();
                    }

                    function draw(e) {
                        if (!drawing) return;
                        const {
                            x,
                            y
                        } = getCoords(e);
                        ctx.lineTo(x, y);
                        ctx.stroke();
                        e.preventDefault();
                    }

                    function stopDrawing() {
                        drawing = false;
                    }

                    // Eventos para mouse
                    canvas.addEventListener('mousedown', startDrawing);
                    canvas.addEventListener('mousemove', draw);
                    canvas.addEventListener('mouseup', stopDrawing);
                    canvas.addEventListener('mouseleave', stopDrawing);

                    // Eventos para toque
                    canvas.addEventListener('touchstart', startDrawing);
                    canvas.addEventListener('touchmove', draw);
                    canvas.addEventListener('touchend', stopDrawing);
                    canvas.addEventListener('touchcancel', stopDrawing);

                    function clearCanvas() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                    }

                    function saveSignature() {
                        const imageData = canvas.toDataURL('image/png');

                        document.getElementById('savedImage').src = imageData;


                        inserirAssinaturaDoUsuario();




                    }
                </script>
</body>

</html>