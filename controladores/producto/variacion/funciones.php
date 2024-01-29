<?php

function get_productosVariacion()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    pv.id, 
                                    pv.nombre, 
                                    pv.descripcion, 
                                    pv.idEstado, 
                                    me.nombre as estado 
                                FROM productovariacion pv 
                                INNER JOIN mae_estado me ON pv.idEstado = me.id ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
