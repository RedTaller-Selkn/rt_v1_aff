<?php

include("../../../config/conexion.php");
include("../../../controladores/ubicacion/ubicacion/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO ubicacion (nombre, descripcion, direccion, idubicaciontipo, idestado) 
                                VALUES (:nombre, :descripcion, :direccion, :idubicaciontipo, :idestado) ");
    $resultado = $stmt->execute(
        array(
            ':nombre'           => $_POST["nombre"],
            ':descripcion'      => $_POST["descripcion"],
            ':direccion'        => $_POST["direccion"],
            ':idubicaciontipo'  => $_POST["idubicaciontipo"],
            ':idEstado'         => $_POST["idEstado"]
        )
    );
    if (!empty($resultado)) {
        echo 'Ubicación creada!';
    }
}

if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE ubicacion 
                                SET nombre=:nombre, descripcion=:descripcion, direccion=:direccion, 
                                    idubicaciontipo=:idubicaciontipo, idEstado=:idEstado 
                                WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':nombre'           => $_POST["nombre"],
            ':descripcion'      => $_POST["descripcion"],
            ':direccion'      => $_POST["direccion"],
            ':idubicaciontipo'  => $_POST["idubicaciontipo"],
            ':idEstado'         => $_POST["idEstado"],
            ':id'               => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Ubicación actualizada!';
    }
}
