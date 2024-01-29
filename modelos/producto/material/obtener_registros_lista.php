<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/material/funciones.php");

$query = "  SELECT 
                pm.id, 
                pm.nombre, 
                pm.descripcion, 
                pm.idEstado, 
                me.nombre as estado  
            FROM productomaterial pm 
            INNER JOIN mae_estado me ON pm.idEstado = me.id ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
