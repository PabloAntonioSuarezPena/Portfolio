<?php
header('Content-Type: application/JSON');
require_once "../../vendor/autoload.php";
// include "Biblioteca/funciones.php";


$method = $_SERVER['REQUEST_METHOD'];

const DIR = [0 => "Biblioteca/", 1 => "../../app/modelo/", 2 => "../../bd/"]; 
spl_autoload_register(function ($clase) { 
    if (file_exists(DIR[0] . $clase . ".php")) require DIR[0] . $clase . ".php"; 
    if (file_exists(DIR[1] . $clase . ".php")) require DIR[1] . $clase . ".php"; 
    if (file_exists(DIR[2] . $clase . ".php")) require DIR[2] . $clase . ".php"; 
});
Cors::cors();


    switch ($method) {
        case 'GET': // consulta            
            Funciones::metodosGet();
            break;
        case 'DELETE': // consulta            
            Funciones::deleteTerreno();
            break;
        default:  // METODO NO SOPORTADO       
            header("HTTP/1.0 400 Bad Request");
            break;
    }
