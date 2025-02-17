<?php

class ControllerApicultura
{
    use FiltrarTraitMatriz, ErrorSesionTrait;

    public static function home()
    {
        include 'app/vista/cabecera.php';
        include 'app/vista/fondo.php';
        include 'app/vista/pie.php';
    }
    
    public static function homeArrendador()
    {
        if(!isset($_COOKIE['idArrendador'])){
            Self::cerrarSesion();
        }else{
            setcookie("idArrendador", $_SESSION['idCliente'], time()+3600);
            include 'app/vista/cabeceraArendador.php';
            include 'app/vista/tablaArrendador.php';
            include 'app/vista/pie.php';
        }
    }
    
    public static function homeApicultor()
    {
        if(!isset($_COOKIE['idApicultor'])){
            Self::cerrarSesion();
        }else{
            setcookie("idApicultor", $_SESSION['idCliente'], time()+3600);
            include 'app/vista/cabecera.php';
            include 'app/vista/menuApicultor.php';
            include 'app/vista/pie.php';
        }
    }

    public function validar()
    {
        
        $error = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::filtrarM($_POST);
            if (isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['usuarios'])) {
                if ($_POST['usuarios'] == 'apicultor') {
                    if ($recibidos = Clave::claveApicultor($_POST['correo'])) {
                        if (password_verify($_POST['clave'], $recibidos["hash"])) {
                            self::iniciarSesionApicultor($recibidos);
                            header('location:index.php?ctl=homeApicultor');
                            exit;
                        }              
                    }
                }else if($_POST['usuarios'] == 'arrendador') {
                    if ($recibidos = Clave::claveArrendador($_POST['correo'])) {
                        if (password_verify($_POST['clave'], $recibidos["hash"])) {
                            self::iniciarSesionArrendador($recibidos);
                            header('location:index.php?ctl=verTerrenos');
                            exit;
                        }              
                    }
                }else{
                    $error = true;
                }
            }
            $error = true;
        }
        include 'app/vista/cabecera.php';
        require 'app/vista/login.php';
        include 'app/vista/pie.php';
    }

    public static function cerrarSesion()
    {
        ErrorSesionTrait::errorSesion();
    }

    private static function iniciarSesionApicultor($recibidos)
    {
        $_SESSION['idCliente'] = $recibidos['idApicultor'];
        $_SESSION['DNI'] = $recibidos['DNI/NIF'];
        $_SESSION['Nombre'] = $recibidos['Nombre'];
        $_SESSION['foto'] = $recibidos['foto'];
        setcookie("idApicultor", $_SESSION['idCliente'], time()+3600);
        ErrorSesionTrait::errorSesion();
        $error = 0;
    }

    private static function iniciarSesionArrendador($recibidos)
    {
        $_SESSION['idCliente'] = $recibidos['idArrendador'];
        $_SESSION['DNI'] = $recibidos['DNI/NIF'];
        $_SESSION['Nombre'] = $recibidos['Nombre'];
        $_SESSION['foto'] = $recibidos['foto'];
        setcookie("idArrendador", $_SESSION['idCliente'], time()+3600);
        ErrorSesionTrait::errorSesion();
        $error = 0;
    }

    public static function nuevoTerreno()
    {
        if(!isset($_COOKIE['idArrendador'])){
            Self::cerrarSesion();
        }else{
            include 'app/vista/cabeceraArendador.php';
            include 'app/vista/formNuevoTerreno.php';
            include 'app/vista/pie.php';
        }
    }
    public static function validarFormTerreno()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::filtrarM($_POST);
            if (isset($_POST) && isset($_POST['nombre']) && isset($_POST['superficie']) 
                && isset($_POST['CatRef']) && isset($_POST['terrenos'])) {
                    if (is_numeric($_POST['superficie'])) {
                        setcookie("idArrendador", $_SESSION['idCliente'], time()+3600);
                        Arrendador::insertarTerreno();
                        header("Location: index.php?ctl=verTerrenos");
                        exit;
                    }
            }else{
                ControllerApicultura::nuevoTerreno();
            }
        }else{
            ControllerApicultura::nuevoTerreno();
        }
    }
    public static function confirmarBorrado()
    {
        if (isset($_GET) && isset($_GET['idTerreno']) && is_numeric($_GET['idTerreno'])) {
            include 'app/vista/cabeceraArendador.php';
            include 'app/vista/formBorrado.php';
            include 'app/vista/pie.php';
        }else{
            ControllerApicultura::homeArrendador();
        }

    }


}
