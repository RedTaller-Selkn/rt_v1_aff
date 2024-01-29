<?php

function get_productosCategoria()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    pc.id, 
                                    pc.nombre, 
                                    pc.descripcion, 
                                    pc.idEstado, 
                                    me.nombre as estado 
                                FROM productocategoria pc 
                                INNER JOIN mae_estado me ON pc.idEstado = me.id  ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
