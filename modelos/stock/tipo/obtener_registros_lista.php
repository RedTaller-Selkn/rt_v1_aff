<?php

include("../../../config/conexion.php");
include("../../../controladores/stock/tipo/funciones.php");

$query = "  SELECT 
                id, 
                nombre, 
                descripcion
            FROM stocktipo";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
