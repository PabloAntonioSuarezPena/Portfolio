<?php
include_once '../../bd/Conectar.php';
class Api extends Conectar
{

    public static function getTerrenos($idArrendador){
        try {
            $conexion=Conectar::conexion();
            $sql = "SELECT terreno.idTerreno, terreno.nombre, terreno.superficie, 
                    terreno.referencia_catastro, terreno.estado, tipoterrenos.nombre AS nombreTerreno, 
                    apicultor.Nombre as usuario
            FROM terreno
                JOIN apicultor ON apicultor.idApicultor = terreno.idApicultor
                JOIN tipoterrenos ON tipoterrenos.tipo_terreno = terreno.tipo_terreno
            WHERE terreno.idArrendador = :idArrendador and estado = 1;";
            $enlace_datos = $conexion->prepare($sql);
            $enlace_datos->bindParam(':idArrendador', $idArrendador);
            $enlace_datos->execute();
            while ($fila = $enlace_datos->fetch(PDO::FETCH_ASSOC)) {
                $todos[] = $fila;
            }
            $sql = "SELECT terreno.idTerreno, terreno.nombre, terreno.superficie, 
                    terreno.referencia_catastro, terreno.estado, tipoterrenos.nombre AS nombreTerreno, 
                    '----' as usuario
            FROM terreno
                JOIN tipoterrenos ON tipoterrenos.tipo_terreno = terreno.tipo_terreno
            WHERE terreno.idArrendador = :idArrendador and estado = 0;";
            $enlace_datos = $conexion->prepare($sql);
            $enlace_datos->bindParam(':idArrendador', $idArrendador);
            $enlace_datos->execute();
            while ($fila = $enlace_datos->fetch(PDO::FETCH_ASSOC)) {
                $todos[] = $fila;
            }
            $enlace_datos->closeCursor();
            return @$todos;
        } catch (PDOException $e) {
            // return false; 
            exit("Error: " . $e->getMessage(). $e->getLine());
        }
    }
    public static function getTiposTerrenos(){
        try {
            $conexion=Conectar::conexion();
            $sql = "SELECT tipo_terreno, nombre FROM tipoterrenos";
            $enlace_datos = $conexion->prepare($sql);
            $enlace_datos->execute();
            while ($fila = $enlace_datos->fetch(PDO::FETCH_ASSOC)) {
                $todos[] = $fila;
            }
            $enlace_datos->closeCursor();
            return @$todos;
        } catch (PDOException $e) {
            // return false; 
            exit("Error: " . $e->getMessage(). $e->getLine());
        }
    }

    public static function deleteTerrenoById($idTerreno){
        try {
            $conexion=Conectar::conexion();
            $sql = "DELETE FROM terreno WHERE idTerreno = :idTerreno";
            $enlace_datos = $conexion->prepare($sql);
            $enlace_datos->bindParam(':idTerreno', $idTerreno);
            $enlace_datos->execute();
            $fila = $enlace_datos->fetch(PDO::FETCH_ASSOC);
            if (!$fila) {
                $fila = "DATO ELIMINADO";
            }
            $enlace_datos->closeCursor();
            return @$fila;
        } catch (PDOException $e) {
            // return false; 
            return("Error: " . $e->getMessage(). $e->getLine());
            exit;
        }
    }


}