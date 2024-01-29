<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/modelo/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST["id"])) {
    $stmt = $conexion->prepare("UPDATE productomodelo 
                                SET idEstado=3 
                                WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':id' => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Modelo de producto eliminado!';
    }
}
