<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/mae_producto/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST["id"])) {
    $imagen = get_imagen_nombre($_POST["id"]);
    if ($imagen != "") {
        unlink("img/productos/" . $_POST["id"]);
    }
    $stmt = $conexion->prepare("UPDATE producto 
                                SET idEstado=3 
                                WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':id' => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Producto eliminado!';
    }
}
