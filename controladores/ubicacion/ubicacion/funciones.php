<?php

function get_ubicacion()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    ub.id, 
                                    ub.nombre, 
                                    ub.descripcion, 
                                    ub.idubicaciontipo, 
                                    ut.nombre as ubicaciontipo, 
                                    ub.idestado, 
                                    me.nombre as estado 
                                FROM ubicacion ub 
                                INNER JOIN mae_estado me ON ub.idestado = me.id 
                                INNER JOIN ubicaciontipo ut ON ub.idubicaciontipo = ut.id");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
