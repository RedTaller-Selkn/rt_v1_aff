<?php

include("../../../config/conexion.php");
include("../../../controladores/stock/tipo/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST["id"])) {
    $stmt = $conexion->prepare("DELETE FROM stockestado  
                                WHERE id=:id");
    $resultado = $stmt->execute(
        array(
            ':id' => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Tipo de stock eliminado!';
    }
}
