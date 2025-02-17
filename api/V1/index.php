<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Apicultura</title>
    <link rel="stylesheet" href="CSS/apicultura.css" type="text/css">
</head>

<body>

    <div class="container">
        <h1>API ApiCultura</h1>
        <div class="divbody">
            <h2>URL API</h2>
            <code><?= $ruta = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']); ?></code>

            <h2>Apicultura</h2>
            <code>
                <span class='v'>GET</span> /apicultura/arrendador/id &nbsp;&nbsp;&nbsp;&nbsp;<i style="color:#808000" ;>Lista todos los terrenos de un usuario arrendador</i>
                <br><br>
            </code>
        </div>
    </div>
</body>

</html>