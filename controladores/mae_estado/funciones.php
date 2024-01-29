<?php

function get_estado()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();


    $stmt = $cliente->prepare("SELECT * FROM mae_estado ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
