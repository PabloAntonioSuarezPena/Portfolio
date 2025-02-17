<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Funciones{

    public static function metodosGet(){
        if (isset($_SERVER['PATH_INFO'])) {
            $datosUrl = explode("/", $_SERVER['PATH_INFO']);
            switch ($datosUrl[1]) {
                case 'arrendador':
                    self::getTerrenos();
                    break;
                case 'tipoTerrenos':
                    self::getTipoTerrenos();
                    break;
                default:
                    header("HTTP/1.0 400 Bad Request");
                    break;
            }
        }else{
            header("HTTP/1.0 400 Bad Request");
            echo(json_encode(["Error: "=>"url mal construida"], JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
        }
    }

    public static function getTerrenos()
    {
        if(is_numeric($_GET['id'])){
            $info = Api::getTerrenos($_GET['id']);
            $datos = json_encode($info, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
            echo($datos);
        }else{
            header("HTTP/1.0 400 Bad Request");
            echo(json_encode(["Error: "=>"url mal construida"], JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
        }

    }
    public static function getTipoTerrenos()
    {
        $info = Api::getTiposTerrenos();
        $datos = json_encode($info, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        echo($datos);
    }

    public static function deleteTerreno(){

        if(is_numeric($_GET['id']) && is_numeric($_GET['idTerreno'])){
            $info = Api::deleteTerrenoById($_GET['idTerreno']);

            $datos = json_encode($info, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
            echo($datos);
        }else{
            header("HTTP/1.0 400 Bad Request");
            echo(json_encode(["Error: "=>"url mal construida"], JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
        }
    
    }
}
/*  Respuesta al cliente:
        1. 200 : OK → La solicitud ha tenido éxito
        2. 201 : Created → La solicitud ha tenido éxito y se ha creado un nuevo recurso
        3. 204 : No Content → La petición se ha completado con éxito, pero su respuesta no tiene ningún contenido
        4. 400 : Bad Request → La solicitud contiene sintaxis errónea y no debería repetirse
        5. 401 : Unauthorized → La solicitud no se ha procesado, faltan de credenciales de autenticación válidas
        5. 404 : Not Found → El servidor no pudo encontrar el contenido solicitado
        6. 422 : Unprocessable Entity → Entidad no procesable
        7. 500 : Internal Server Error → Se ha producido un error interno
   */



