<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assinatura Digital</title>
  <style>
    body {
      font-family: sans-serif;
      text-align: center;
      margin: 20px;
    }

    canvas {
      border: 2px solid #000;
      border-radius: 8px;
      touch-action: none;
      cursor: crosshair;
    }

    .buttons {
      margin-top: 15px;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      margin: 0 10px;
    }

    img {
      margin-top: 20px;
      max-width: 100%;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js">

  </script>
</head>

<body style="background-color:rgb(216, 216, 219);">


  <p><b>Assinatura Mais Digital</b></p>

  <script>






  </script>


  <div id="infoSucesso">
    <center>
      <h1>Nós Colhemos sua assinatura com sucesso! <br> Volte para o mais digital no seu computador!</h1>
    </center>

  </div>


  <div id="colherAssinatura">

    <canvas id="signatureCanvas" width="700" height="150" style="background-color: white;"></canvas>

    <input type="text" id="idSolicitacao" style="display: none;" value="<?= $_GET['idSolicitacao'] ?>" />

    <div class="buttons">
      <button style="background-color: rgb(30, 32, 37); border-radius: 10px; ; color: white;" onclick="clearCanvas()">Limpar</button>
      <button style="background-color: rgb(30, 32, 37);  border-radius: 10px; color: white;" onclick="saveSignature()">Salvar</button>

    </div>


    <img id="savedImage" style="display: none;" alt="Assinatura aparecerá aqui" />


    <?php



    ?>
    <button type="submit" style="display: none;" onclick="inserirAssinaturaDoUsuario()">Enviar Imagem</button>

  </div>


  <div id="mostraRodarImagem">

    <button onclick="rotate(this)" id="button" style="width: 100%; ">

    </button>
    <button onclick="screen.orientation.unlock()" style="display: none;">
      Unlock
    </button>
  </div>


  <script>
    $(document).ready(function() {
      $('#infoSucesso').hide();
      $('#colherAssinatura').hide()

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



    //sobre a assinatura
    function pegarAss() {

      var assinatura = $("#savedImage").attr("src");




    }


    function inserirAssinaturaDoUsuario(assinaturaTerceiro) {

 
     
      var assinatura = $("#savedImage").attr("src");

      var formData = {
        assinatura,
        assinaturaTerceiro,
        idSolicitacao: $('#idSolicitacao').val()
      };
      var condicao;
      $.ajax({
          type: 'POST',
          url: 'ajax/salvaAssinaturaController.php',
          data: formData,
          dataType: 'html',
          encode: true
        })
        .done(function(data) {
          console.log(data);
          
          if (data.retorno == true) {
            $('#colherAssinatura').hide();
            $('#infoSucesso').show();
            screen.orientation.unlock();

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


      <?php

      if (isset($_GET['112ff6666a78800f14e115ef8e7a57a5'])) {

        echo 'inserirAssinaturaDoUsuario(1)';
      } else {
        echo 'inserirAssinaturaDoUsuario(0)';
      }
      ?>




    }
  </script>
</body>

</html>