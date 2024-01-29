<?php

include("../../../config/conexion.php");
include("../../../controladores/stock/egreso/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO stockegresos (nombre, descripcion, numero, cantidadtotal, costototal, iva, idusuario, idstocktipo, idstockestado) 
                                VALUES (:nombre, :descripcion, :numero, :cantidadtotal, :costototal, :iva, :idusuario, :idstocktipo, :idstockestado) ");

    $resultado = $stmt->execute(
        array(
            ':nombre'           => $_POST["nombre"],
            ':descripcion'      => $_POST["descripcion"],
            ':numero'           => $_POST["numero"],
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
        echo 'Egreso creado!';
    }
}

if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE ubicacion 
                                SET 
                                    nombre=:nombre, 
                                    descripcion=:descripcion, 
                                    numero=:numero, 
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
            ':numero'           => $_POST["numero"],
            ':cantidadtotal'    => $_POST["cantidadtotal"],
            ':costototal'       => $_POST["costototal"],
            ':iva'              => $_POST["iva"],
            ':idstocktipo'      => $_POST["idstocktipo"],
            ':idstockestado'    => $_POST["idstockestado"],
            ':id'               => $_POST["id"]
        )
    );

    if (!empty($resultado)) {
        echo 'Egreso actualizado!';
    }
}
