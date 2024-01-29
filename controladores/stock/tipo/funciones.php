<?php

function get_stocktipo()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    id, 
                                    nombre, 
                                    descripcion
                                FROM stocktipo  ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
