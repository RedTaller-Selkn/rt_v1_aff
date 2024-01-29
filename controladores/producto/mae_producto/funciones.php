<?php

function subir_imagen()
{
    if (isset($_FILES["imagen_producto"])) {
        var_dump($_FILES);
        $extension = explode('.', $_FILES["imagen_producto"]['name']);
        $nuevo_nombre = rand() . '.' . $extension[1];
        //C:\xampp\htdocs\sistema\img\productos
        $ubicacion = '../../img/productos/' . $nuevo_nombre;
        move_uploaded_file($_FILES["imagen_producto"]['tmp_name'], $ubicacion);
        return $nuevo_nombre;
    }
}

function get_imagen_nombre($id)
{
    //include "config/conexion.php";
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT imagen 
                                FROM producto 
                                WHERE id = 'id' ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        return $fila["imagen"];
    }
}

function get_productos()
{
    //include "config/conexion.php";
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();

    $stmt = $cliente->prepare(" SELECT 
                                    p.nombre AS nombre, 
                                    p.descripcion AS descripcion, 
                                    p.codBarra AS codBarra, 
                                    p.imagen AS imagen, 
                                    p.idUsuario AS idUsuario, 
                                    p.idFicha AS idFicha, 
                                    p.idTipoCantidad AS idTipoCantidad, 
                                    p.idEstado AS idEstado, 
                                    e.nombre AS estado 
                                FROM producto p
                                INNER JOIN mae_estado e ON p.idEstado=e.id ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
