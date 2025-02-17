<?php

// include_once '../../bd/Conectar.php';
class Clave extends Conectar
{
    public static function claveApicultor($correo)
    {
        try {
            $sql = "SELECT * FROM apicultor WHERE correo = :correo";
            $consulta = Conectar::conexion()->prepare($sql);
            $consulta->bindParam(':correo', $correo, PDO::PARAM_STR, 50);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit("<h1><br>Fichero: " . $e->getFile() . "<br>Línea: " . $e->getLine() . "<br>Error: " . $e->getMessage() . "</h1>");
        }
    }

    public static function claveArrendador($correo)
    {
        try {
            $sql = "SELECT * FROM arrendador WHERE correo = :correo";
            $consulta = Conectar::conexion()->prepare($sql);
            $consulta->bindParam(':correo', $correo, PDO::PARAM_STR, 50);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit("<h1><br>Fichero: " . $e->getFile() . "<br>Línea: " . $e->getLine() . "<br>Error: " . $e->getMessage() . "</h1>");
        }
    }
}
?>