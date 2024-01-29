<?php

function get_ubicacionTipo()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    ut.id, 
                                    ut.nombre, 
                                    ut.descripcion, 
                                    ut.idEstado, 
                                    me.nombre as estado 
                                FROM ubicaciontipo ut 
                                INNER JOIN mae_estado me ON ut.idEstado = me.id ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
