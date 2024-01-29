<?php

function get_productosMarca()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    m.id, 
                                    m.nombre, 
                                    m.descripcion, 
                                    m.idEstado, 
                                    me.nombre as estado 
                                FROM marca m
                                INNER JOIN mae_estado me ON m.idEstado = me.id");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
