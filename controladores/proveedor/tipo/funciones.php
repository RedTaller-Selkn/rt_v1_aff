<?php

function get_proveedorTipo()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    pt.id, 
                                    pt.nombre, 
                                    pt.descripcion, 
                                    pt.idEstado, 
                                    me.nombre AS estadoNombre 
                                FROM proveedortipo pt 
                                INNER JOIN mae_estado me ON pt.idEstado = me.id  ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
