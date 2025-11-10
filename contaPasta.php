<?php





$path = "logosPrefs/";

$diretorio = scandir($path);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php


    $logosPNG = [];
    $textoPNGVERTICAL = [];
    $textoHorizontalEncurtado = [];
    $textoHorizontalSimples = [];

    foreach ($diretorio as  $value) {
        $logos = explode('.', $value);

        if (end($logos) == 'png') {
            //array_push($logosPDF, $value);

            //if (str_contains($value, 'VERTICAL')) {



            switch ($value) {
                case  str_contains($value, 'CONTORNO') && str_contains($value, 'VERTICAL'):
                    array_push($textoPNGVERTICAL, '<h1>Contorno - Vertical</h1>');
                    break;
                case     str_contains($value, 'COR')  && str_contains($value, 'VERTICAL'):
                    array_push($textoPNGVERTICAL, '<h1>COLORIDO - Verticalizado</h1>');
                    break;

                case     str_contains($value, 'OUTLINE') && str_contains($value, 'VERTICAL'):
                    array_push($textoPNGVERTICAL, '<h1>OUTLINE - Verticalizado</h1>');
                    break;
                case     str_contains($value, 'POSITIVO')  && str_contains($value, 'VERTICAL'):

                    array_push($textoPNGVERTICAL, '<h1>POSITIVO - Verticalizado</h1>');
                    break;


                //horizontal encurtaodo (prefixo b)

                case  str_contains($value, 'CONTORNO') && str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalEncurtado, '<h1>Contorno - Horizontal</h1>');
                    break;
                case     str_contains($value, 'COR')  && str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalEncurtado, '<h1>COLORIDO - Horizontal</h1>');
                    break;

                case     str_contains($value, 'OUTLINE') && str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalEncurtado, '<h1>OUTLINE - Horizontal</h1>');
                    break;
                case     str_contains($value, 'POSITIVO')  && str_contains($value, 'HORIZONTAL_B'):

                    array_push($textoHorizontalEncurtado, '<h1>POSITIVO - Horizontal</h1>');
                    break;


                //horizontal normalprefixo b)

                case  str_contains($value, 'CONTORNO') && str_contains($value, 'HORIZONTAL')  && !str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalSimples, '<h1>Contorno - Horizontal normal</h1>');
                    break;
                case     str_contains($value, 'COR')  && str_contains($value, 'HORIZONTAL')  && !str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalSimples, '<h1>COLORIDO - Horizontal</h1>');
                    break;

                case     str_contains($value, 'OUTLINE') && str_contains($value, 'HORIZONTAL')  && !str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalSimples, '<h1>OUTLINE - Horizontal</h1>');
                    break;
                case     str_contains($value, 'POSITIVO')  && str_contains($value, 'HORIZONTAL')  && !str_contains($value, 'HORIZONTAL_B'):

                    array_push($textoHorizontalSimples, '<h1>POSITIVO - Horizontal</h1>');
                    break;







                default:
                    echo '<h1>deu merda</h1>';
                    break;
            }







    ?>






        <?php
            //}
        }






        ?>




    <?php
    }
    print_r($textoPNGVERTICAL);

    echo '<h1>HOrizontal</h1>';

    print_r($textoHorizontalEncurtado);

    echo '<h1>HOrizontal numa boa</h1>';

    print_r($textoHorizontalSimples);



    ?>

</body>

</html>