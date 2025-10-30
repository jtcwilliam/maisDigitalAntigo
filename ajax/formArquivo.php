<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="gravarArquivoController.php"  method="post" enctype="multipart/form-data">

            <input type="hidden" name="nomeArquivo" value="envioArquivo"  />

            <input type="file" name="file" />
            
            <input type="submit"  value="enviar" />

    </form>
</body>
</html>