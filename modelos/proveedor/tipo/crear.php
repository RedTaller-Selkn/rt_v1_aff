<?php

include("../../../config/conexion.php");
include("../../../controladores/proveedor/tipo/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO proveedortipo (nombre, descripcion, idEstado) 
                                VALUES (:nombre, :descripcion, :idEstado)");

    $resultado = $stmt->execute(
        array(
            ':nombre'       => $_POST["nombre"],
            ':descripcion'  => $_POST["descripcion"],
            ':idEstado'     => $_POST["idEstado"]
        )
    );

    if (!empty($resultado)) {
        echo 'Variación de Producto creado!';
    }
}

if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE proveedortipo SET nombre=:nombre, descripcion=:descripcion, idEstado=:idEstado WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':nombre'       => $_POST["nombre"],
            ':descripcion'  => $_POST["descripcion"],
            ':idEstado'     => $_POST["idEstado"],
            ':id'       => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Variacion de Producto actualizado!';
    }
}
