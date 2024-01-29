<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/categoria/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST["id"])) {
    $stmt = $conexion->prepare("UPDATE productocategoria 
                                SET idEstado=3 
                                WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':id' => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Categoría de producto eliminado!';
    }
}
