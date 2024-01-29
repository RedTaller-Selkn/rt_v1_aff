<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/mae_producto/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if ($_POST["operacion"] == "Crear") {
    $imagen = '';
    if ($_FILES["imagen_producto"]["name"] != '') {
        $imagen = subir_imagen();
    }
    $stmt = $conexion->prepare("INSERT INTO producto (nombre, descripcion, codBarra, imagen, idUsuario, idFicha, idTipoCantidad, idCategoria, idTipo, idMaterial, idModelo, idVariacion, idEstado) 
                                VALUES (:nombre, :descripcion, :codBarra, :imagen, :idUsuario, :idFicha, :idTipoCantidad, :idCategoria, :idTipo, :idMaterial, :idModelo, :idVariacion, :idEstado)");

    $resultado = $stmt->execute(
        array(
            ':nombre'       => $_POST["nombre"],
            ':descripcion'  => $_POST["descripcion"],
            ':codBarra'     => $_POST["codBarra"],
            ':imagen'       => $imagen,
            ':idUsuario'    => $_POST["idUsuario"],
            ':idFicha'      => $_POST["idFicha"],
            ':idTipoCantidad'   => $_POST["idTipoCantidad"],
            ':idCategoria'  => $_POST["idCategoria"],
            ':idTipo'       => $_POST["idTipo"],
            ':idMaterial'   => $_POST["idMaterial"],
            ':idModelo'     => $_POST["idModelo"],
            ':idVariacion'  => $_POST["idVariacion"],
            ':idEstado'     => $_POST["idEstado"]
        )
    );

    if (!empty($resultado)) {
        echo 'Producto creado!';
    } else {
        echo 'Producto ya existe!';
    }
}

if ($_POST["operacion"] == "Editar") {

    $imagen = '';
    if ($_FILES["imagen_producto"]["name"] != '') {
        $imagen = subir_imagen();
    } else {
        $imagen = $_POST["img"];
    }

    $stmt = $conexion->prepare("UPDATE producto 
    SET nombre=:nombre,                 descripcion=:descripcion, 
        codBarra=:codBarra,             imagen=:imagen, 
        idUsuario=:idUsuario,           idFicha=:idFicha, 
        idTipoCantidad=:idTipoCantidad, idCategoria=:idCategoria, 
        idTipo=:idTipo,                 idMaterial=:idMaterial, 
        idModelo=:idModelo,             idVariacion=:idVariacion , 
        idEstado=:idEstado 
    WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':nombre'       => $_POST["nombre"],
            ':descripcion'  => $_POST["descripcion"],
            ':codBarra'     => $_POST["codBarra"],
            ':imagen'       => $imagen,
            ':idUsuario'    => $_POST["idUsuario"],
            ':idFicha'      => $_POST["idFicha"],
            ':idTipoCantidad'   => $_POST["idTipoCantidad"],
            ':idCategoria'  => $_POST["idCategoria"],
            ':idTipo'       => $_POST["idTipo"],
            ':idMaterial'   => $_POST["idMaterial"],
            ':idModelo'     => $_POST["idModelo"],
            ':idVariacion'  => $_POST["idVariacion"],
            ':idEstado'     => $_POST["idEstado"],
            ':id'           => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Producto actualizado!';
    } else {
        echo 'Producto ya existe!';
    }
}
