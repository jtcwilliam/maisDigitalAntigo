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

    <a href=""></a>
    <?php


    $logosPNG = [];
    $textoPNGVERTICAL = [];
    $textoHorizontalEncurtado = [];
    $textoHorizontalSimples = [];


    echo '<pre>';
    print_r($diretorio);


    foreach ($diretorio as  $value) {

        $logos = explode('.', $value);

        if (end($logos) == 'png') {
            //array_push($logosPDF, $value);

            //if (str_contains($value, 'VERTICAL')) {



            switch ($value) {
                case  str_contains($value, 'CONTORNO') && str_contains($value, 'VERTICAL'):
                    array_push($textoPNGVERTICAL, '<h3>Vertical  - Contorno</h3><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;
                case     str_contains($value, 'COR')  && str_contains($value, 'VERTICAL'):
                    array_push($textoPNGVERTICAL, '<h3>COLORIDO - Verticalizado</h3><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;

                case     str_contains($value, 'OUTLINE') && str_contains($value, 'VERTICAL'):
                    array_push($textoPNGVERTICAL, '<h4>OUTLINE - Verticalizado</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;
                case     str_contains($value, 'POSITIVO')  && str_contains($value, 'VERTICAL'):

                    array_push($textoPNGVERTICAL, '<h4>POSITIVO - Verticalizado</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;


                //horizontal encurtaodo (prefixo b)

                case  str_contains($value, 'CONTORNO') && str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalEncurtado, '<h4>Contorno - Horizontal</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;
                case     str_contains($value, 'COR')  && str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalEncurtado, '<h4>COLORIDO - Horizontal</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;

                case     str_contains($value, 'OUTLINE') && str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalEncurtado, '<h4>OUTLINE - Horizontal</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;
                case     str_contains($value, 'POSITIVO')  && str_contains($value, 'HORIZONTAL_B'):

                    array_push($textoHorizontalEncurtado, '<h4>POSITIVO - Horizontal</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;


                //horizontal normalprefixo b)

                case  str_contains($value, 'CONTORNO') && str_contains($value, 'HORIZONTAL')  && !str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalSimples, '<h4>Contorno - Horizontal normal</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;
                case     str_contains($value, 'COR')  && str_contains($value, 'HORIZONTAL')  && !str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalSimples, '<h4>COLORIDO - Horizontal</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;

                case     str_contains($value, 'OUTLINE') && str_contains($value, 'HORIZONTAL')  && !str_contains($value, 'HORIZONTAL_B'):
                    array_push($textoHorizontalSimples, '<h4>OUTLINE - Horizontal</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;
                case     str_contains($value, 'POSITIVO')  && str_contains($value, 'HORIZONTAL')  && !str_contains($value, 'HORIZONTAL_B'):

                    array_push($textoHorizontalSimples, '<h4>POSITIVO - Horizontal</h4><a href="logosPrefs/'.$value.'" ><img src="logosPrefs/'.$value.'" style="width: 20%"  /></a>');
                    break;







                default:
                    echo '<h4>deu merda</h4>';
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

    echo '<h4>HOrizontal</h4>';

    print_r($textoHorizontalEncurtado);

    echo '<h4>HOrizontal numa boa</h4>';

    print_r($textoHorizontalSimples);



    ?>

</body>

</html>