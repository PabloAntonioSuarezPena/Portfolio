<?php
trait ErrorSesionTrait
{
    public static function errorSesion()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['DNI'])) {
            $_SESSION = array();
            session_destroy();
            setcookie(session_name(), null, time() - 99999, '/', $_SERVER['HTTP_HOST']);
            ControllerApicultura::home();
        }
    }
}
