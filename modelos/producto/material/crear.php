<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/material/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if($_POST["operacion"] == "Crear"){
    $stmt = $conexion->prepare("INSERT INTO productomaterial (nombre, descripcion, idEstado) 
                                VALUES (:nombre, :descripcion, :idEstado)");

    $resultado = $stmt->execute(
        array(
            ':nombre'       => $_POST["nombre"],
            ':descripcion'  => $_POST["descripcion"],
            ':idEstado'     => $_POST["idEstado"]
        )
    );

    if(!empty($resultado)){
        echo 'Material de Producto creado!';
    }
}

if($_POST["operacion"] == "Editar"){
    $stmt = $conexion->prepare("UPDATE productomaterial 
                                SET nombre=:nombre, descripcion=:descripcion, idEstado=:idEstado 
                                WHERE id=:id"); 

    $resultado = $stmt->execute(
        array(
            ':nombre'       => $_POST["nombre"],
            ':descripcion'  => $_POST["descripcion"],
            ':idEstado'     => $_POST["idEstado"],
            ':id'           => $_POST["id"]
        )
    );

    if(!empty($resultado)){
        echo 'Material de Producto actualizado!';
    }
}