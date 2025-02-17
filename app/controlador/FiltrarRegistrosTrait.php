<?php
trait FiltrarRegistrosTrait
{
    public static function filtrarNombre(&$nombre, &$errorValidar)
    {
        if(!empty($nombre) && preg_match('/^[a-zA-Z]+$/', $nombre) && strlen($nombre > 50)){
                $errorValidar = false;
                return strtoupper($nombre);
        }else{
            $errorValidar = true;
        }
    }
    public static function filtrarApellidos(&$apellidos, &$errorValidar)
    {
        if(!empty($apellidos) && preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ ]+$/', $apellidos) && strlen($apellidos > 50)){
                $errorValidar = false;
                return strtoupper($apellidos);
        }else{
            $errorValidar = true;
        }
    }
    public static function filtrarNif($nif, &$errorValidar)
    {
        if(!empty($nif)){
            if(!is_numeric($nif)){
                if (preg_match('/^\d{8}[a-zA-Z]{1}$/', $nif)) {
                    $nif = substr($nif, 0, 8) . "-" . strtoupper(substr($nif, 8, 9));
                    $errorValidar = false;
                    return $nif;
                } else {
                    $errorValidar = true;
                }
            }else{
                $errorValidar = true;
            }
        }else{
            $errorValidar = true;
        }
    }
    public static function filtrarAlias($alias, &$errorValidar)
    {
        if(!empty($alias) && preg_match('/^[a-zA-Z]+$/', $alias) && strlen($alias > 50)){
            $errorValidar = false;
            return $alias;
        }else{
            $errorValidar = true;
        }
    }
    public static function filtrarCorreo($correo, &$errorValidar)
    {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errorValidar = false;
            return $correo;
        } else {
            $errorValidar = true;
        }
        
    }
    public static function filtrarClave($clave1, $clave2, &$errorValidar)
    {
        if ($clave1 == $clave2 && strlen($clave1 > 6) && strlen($clave2 > 6)) {
            $errorValidar = false;
            return $clave1;
        } else {
            $errorValidar = true;
        }
    }
    public static function filtrarNombreAnimal($nombreAnimal ,&$errorValidar)
    {
        if(!empty($nombreAnimal) && preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ ]+$/', $nombreAnimal) && strlen($nombreAnimal > 50)){
            $errorValidar = false;
            return $nombreAnimal;
        }else{
            $errorValidar = true;
        }
    }
    public static function filtrarTipo($tipoAnimal ,&$errorValidar, $listaAnimales)
    {
        foreach ($listaAnimales as $key => $value) {
            if($tipoAnimal == $value){
                $errorValidar = false;
                return $key;
            }else{
                $errorValidar = true;  
            } 
        }
    }

    public static function mover_archivo($actual, $ruta)
    {
        $extensiones = array('image/gif', 'image/jpeg', 'image/jpg', 'image/webp', 'image/bmp', 'image/png', 'image/tiff');
        // $array_rutas = array();

        //reduzco en un nivel de $_FILES, volcando sobre una variable el contenido de $_FILES['mis_ficheros]
        $actual;

        // foreach ($actual['error'] as $key => $error) {
            if ($actual['error'] == 0) {
                //mime_content_type — Detecta el MIME Content-type para un fichero
                //le pasamos la dirección del fichero en la carpeta temporal   
                $mime = mime_content_type($actual['tmp_name']);
                //Calculamos el tamaño real del fichero subido por si el cliente ha modificado MAX_FILE_SIZE
                $bytes = filesize($actual['tmp_name']);
                if (!in_array($mime, $extensiones)) {
                    $error = -1;
                    $mensaje = "El fichero con nombre<strong> " . $actual['name'] . '</strong> no admitido,' . " su tipo MIME es: " . $mime;
                } elseif ($bytes > LIMITE_BYTES) {
                    $error = -1;
                    $mensaje = "En el formulario se ha modificado la directiva MAX_FILE_SIZE al subir el archivo <strong>" . $actual['name'] . " </strong>su tamaño es mayor al permitido, ocupa $bytes bytes";
                }
            }else if($actual['error'] == 4) {
                // asigno el icono por defecto 
                return 'icono.jpg';
            }
            //Solo en el caso de que $error sea 0, subido correctamente
            //Muevo el archivo desde la carpeta temporal a la carpeta de mi aplicación.
            if (!$error) {

                //generando un nombre aleatorio para las imagenes con la función time()            

                $valores = pathinfo($actual['name']);

                $aleatorio = (float) microtime() * 1000000;

                $nombre_aleatorio = $valores['filename'] . $aleatorio . '.' . $valores['extension'];

                $ruta_destino_archivo = "web/img/$ruta/$nombre_aleatorio";

                $archivo_ok = @move_uploaded_file($actual['tmp_name'], $ruta_destino_archivo);

                if (!$archivo_ok) {
                    exit("<br><br><h2><center>Aplicación detenida.<br>Error al mover el archivo al servidor, es probable que la ruta de destino no exista o no tengas permisos para escribir esa carpeta</center></h2>");
                } 
                else {
                    return $actual['name'];
                }
            }
    }
}  
?>