<?php

include("../../../config/conexion.php");
include("../../../controladores/stock/tipo/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO stocktipo (nombre, descripcion) 
                                VALUES (:nombre, :descripcion)");
    $resultado = $stmt->execute(
        array(
            ':nombre'       => $_POST["nombre"],
            ':descripcion'  => $_POST["descripcion"]
        )
    );
    if (!empty($resultado)) {
        echo 'Ubicación creada!';
    }
}

if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE stocktipo 
                                SET nombre=:nombre, descripcion=:descripcion
                                WHERE id=:id");
    $resultado = $stmt->execute(
        array(
            ':nombre'       => $_POST["nombre"],
            ':descripcion'  => $_POST["descripcion"],
            ':id'           => $_POST["id"]
        )
    );
    if (!empty($resultado)) {
        echo 'Tipo de stock eliminado!';
    }
}
