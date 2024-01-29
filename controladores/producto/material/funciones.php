<?php

function get_productosMaterial()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    pm.id, 
                                    pm.nombre, 
                                    pm.descripcion, 
                                    pm.idEstado, 
                                    me.nombre as estado  
                                FROM productomaterial pm 
                                INNER JOIN mae_estado me ON pm.idEstado = me.id ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
