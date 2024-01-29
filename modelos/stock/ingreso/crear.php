<?php

include("../../../config/conexion.php");
include("../../../controladores/stock/ingreso/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO stockingresos (nombre, descripcion, ordencompra, cantidadtotal, costototal, iva, idusuario, idstocktipo, idstockestado) 
                                VALUES (:nombre, :descripcion, :ordencompra, :cantidadtotal, :costototal, :iva, :idusuario, :idstocktipo, :idstockestado) ");
                                //VALUES (:nombre, :descripcion, :ordencompra, :cantidadtotal, :costototal, :iva, :idusuario, :fechaingreso, :idstocktipo, :idstockestado) ");
    $resultado = $stmt->execute(
        array(
            ':nombre'           => $_POST["nombre"],
            ':descripcion'      => $_POST["descripcion"],
            ':ordencompra'      => $_POST["ordencompra"],
            ':cantidadtotal'    => $_POST["cantidadtotal"],
            ':costototal'       => $_POST["costototal"],
            ':iva'              => $_POST["iva"],
            ':idusuario'        => $_POST["idusuario"],
            ':idstocktipo'      => $_POST["idstocktipo"],
            ':idstockestado'    => $_POST["idstockestado"]
        )
    );
    if (!empty($resultado)) {
        echo $resultado;
        echo 'Ingreso creado!';
    }
}

if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE ubicacion 
                                SET 
                                    nombre=:nombre, 
                                    descripcion=:descripcion, 
                                    ordencompra=:ordencompra, 
                                    cantidadtotal=:cantidadtotal, 
                                    costototal=:costototal, 
                                    iva=:iva, 
                                    idstocktipo=:idstocktipo, 
                                    idstockestado=:idstockestado 
                                WHERE id=:id");

    $resultado = $stmt->execute(
        array(
            ':nombre'           => $_POST["nombre"],
            ':descripcion'      => $_POST["descripcion"],
            ':ordencompra'      => $_POST["ordencompra"],
            ':cantidadtotal'    => $_POST["cantidadtotal"],
            ':costototal'       => $_POST["costototal"],
            ':iva'              => $_POST["iva"],
            ':idstocktipo'      => $_POST["idstocktipo"],
            ':idstockestado'    => $_POST["idstockestado"],
            ':id'               => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Ingreso actualizado!';
    }
}
