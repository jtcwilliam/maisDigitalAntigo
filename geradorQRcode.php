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

<body style="background-image: url('imgs/fundoSistema.png') ;         background-size: cover ">

    <input type="text" id="txtQr" />
    <button class="button" onclick=" qrCodeAssinatura($('#txtQR').val() );  ">Enviar</button>

    <div id="img"></div>





</body>

<script>
    function qrCodeAssinatura(link) {

        console.log('asdasdasd');



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
</script>


</html>