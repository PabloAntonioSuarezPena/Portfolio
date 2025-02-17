<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web/css/style.css">
    <title>ApiCultura de Pablo Suárez</title>
</head>
<body>
    <div id="navegador">
        <img id="avatar" src="web\img\iconos\JCYL.jpg" alt="Avatar">
        <h1>ApiCultura</h1>
            <ul id="liEnlace">
                <li><a href="index.php?ctl=home">Home</a></li>
                <?php if (!isset($_SESSION['Nombre'])) : ?>
                    <li><a href="index.php?ctl=validar">Login</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="index.php?ctl=registrar">Registrarse</a></li>
                <?php else : ?>
                    <li><a href="index.php?ctl=verTerrenos">Ver terrenos</a></li>
                    <li><a href="index.php?ctl=cerrarSesion">Cerrar Sesión <?=$_SESSION['Nombre'] ?></a></li>
                    <li><img id="avatar" src="web\img\personas\<?= $_SESSION['foto'] ?>" alt="Avatar"></li>
                    <?php endif; ?>
            </ul>
    </div>
    

    
