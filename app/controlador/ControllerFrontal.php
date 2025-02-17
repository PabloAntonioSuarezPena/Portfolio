<?php 

require_once "vendor/autoload.php";
use Dompdf\Dompdf;
!isset($_SESSION['nombre']) ? session_start() : NULL;

const DIR = [0 => "app/controlador/", 1 => "app/modelo/", 2 => "bd/"]; 
spl_autoload_register(function ($clase) { 
    if (file_exists(DIR[0] . $clase . ".php")) require DIR[0] . $clase . ".php"; 
    if (file_exists(DIR[1] . $clase . ".php")) require DIR[1] . $clase . ".php"; 
    if (file_exists(DIR[2] . $clase . ".php")) require DIR[2] . $clase . ".php"; 
});

$map = array(
    'home' => array(
        'controller' => 'ControllerApicultura',
        'action' => 'home',
    ),
    'validar' => array(
        'controller' => 'ControllerApicultura',
        'action' => 'validar',
    ),
    'cerrarSesion' => array(
        'controller' => 'ControllerApicultura',
        'action' => 'cerrarSesion',
    ),
    'verTerrenos' => array(
        'controller' => 'ControllerApicultura',
        'action' => 'homeArrendador',
    ),
    'nuevoTerreno' => array(
        'controller' => 'ControllerApicultura',
        'action' => 'nuevoTerreno',
    ),
    'validarFormTerreno' => array(
        'controller' => 'ControllerApicultura',
        'action' => 'validarFormTerreno',
    ),
    'confirmarBorrado' => array(
        'controller' => 'ControllerApicultura',
        'action' => 'confirmarBorrado',
    ),
    'homeApicultor' => array(
        'controller' => 'ControllerApicultura',
        'action' => 'homeApicultor',
    )
);

// Parseo de la ruta

if (isset($_REQUEST['ctl'])) {
    if (isset($map[$_REQUEST['ctl']])) {
        $ruta = $_REQUEST['ctl'];
    } else {
        header('Status: 404 Not Found');
        echo '<p><h2>Error 404: No existe la ruta <i>' . $_REQUEST['ctl'] . '</h2></p>';
        exit;
    }
} else {
    $ruta = 'home';
}
$controlador = $map[$ruta];

//Ejecución del controlador asociado a la ruta

if (method_exists($controlador['controller'], $controlador['action'])) {
    call_user_func(
        array(
            new $controlador['controller'],
            $controlador['action']
        )
    );
} else {
    header('Status: 404 Not Found');
    echo '<p><h2>Error 404: El controlador <i>' . $controlador['controller'] . '->' . $controlador['action'] .
        '</i> no existe</h2></p>';
}

?>