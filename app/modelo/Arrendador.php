<?php 
include_once 'bd\Conectar.php';
class Arrendador extends Conectar
{
    public static function insertarTerreno()
    {
        try {
            $sql = "INSERT INTO `terreno` 
                (`idTerreno`, `nombre`, `superficie`, `referencia_catastro`, 
                    `estado`, `tipo_terreno`, `idArrendador`, `idApicultor`) 
                VALUES (NULL, :nombre, :superficie, :refCat, '0', :tipoTerreno, :idArrendador, NULL)";
            $enlace_datos = Conectar::conexion()->prepare($sql);
            $enlace_datos -> bindParam('nombre', $_POST['nombre']);
            $enlace_datos -> bindParam('superficie', $_POST['superficie']);
            $enlace_datos -> bindParam('refCat', $_POST['CatRef']);
            $enlace_datos -> bindParam('tipoTerreno', $_POST['terrenos']);
            $enlace_datos -> bindParam('idArrendador', $_COOKIE['idArrendador']);
            $enlace_datos->execute();

            $enlace_datos->closeCursor();
            return "OK";
        } catch (PDOException $e) {
            ControllerApicultura::home();
            exit("Error: " . $e->getMessage());
        }
    }

}
?>