<?php

include("../../../config/conexion.php");
include("../../../controladores/proveedor/mae_proveedor/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO mae_proveedor (nombre, descripcion, razonsocial, rut, giro, direccion, correo, telefono, idproveedortipo, idestado) 
    VALUES (:nombre, :descripcion, :razonsocial, :rut, :giro, :direccion, :correo, :telefono, :idproveedortipo, :idestado) ");

    $resultado = $stmt->execute(
        array(
            ':nombre'           => $_POST["nombre"],
            ':descripcion'      => $_POST["descripcion"],
            ':razonsocial'      => $_POST["razonsocial"],
            ':rut'              => $_POST["rut"],
            ':giro'             => $_POST["giro"],
            ':direccion'        => $_POST["direccion"],
            ':correo'           => $_POST["correo"],
            ':telefono'         => $_POST["telefono"],
            ':idproveedortipo'  => $_POST["idproveedortipo"],
            ':idEstado'         => $_POST["idEstado"]
        )
    );

    if (!empty($resultado)) {
        echo 'Proveedor creado!';
    }
}

if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE mae_proveedor 
                                SET 
                                    nombre=:nombre, 
                                    descripcion=:descripcion, 
                                    razonsocial=:razonsocial, 
                                    rut=:rut, giro=:giro, 
                                    direccion=:direccion, 
                                    correo=:correo, 
                                    telefono=:telefono, 
                                    idproveedortipo=:idproveedortipo, 
                                    idEstado=:idEstado 
                                WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':nombre'           => $_POST["nombre"],
            ':descripcion'      => $_POST["descripcion"],
            ':razonsocial'      => $_POST["razonsocial"],
            ':rut'              => $_POST["rut"],
            ':giro'             => $_POST["giro"],
            ':direccion'        => $_POST["direccion"],
            ':correo'           => $_POST["correo"],
            ':telefono'         => $_POST["telefono"],
            ':idproveedortipo'  => $_POST["idproveedortipo"],
            ':idEstado'         => $_POST["idEstado"]
        )
    );

    if (!empty($resultado)) {
        echo 'Proveedor actualizado!';
    }
}
