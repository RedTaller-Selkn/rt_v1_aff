<?php

include("../../../config/conexion.php");
include("../../../controladores/mae_estado/funciones.php");

$query = "  SELECT 
                id, 
                nombre, 
                descripcion 
            FROM mae_estado  ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
