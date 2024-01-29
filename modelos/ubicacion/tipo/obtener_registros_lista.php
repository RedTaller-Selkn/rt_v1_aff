<?php

include("../../../config/conexion.php");
include("../../../controladores/ubicacion/tipo/funciones.php");

$query = "  SELECT 
                ut.id, 
                ut.nombre, 
                ut.descripcion, 
                ut.idEstado, 
                me.nombre as estado 
            FROM ubicaciontipo ut 
            INNER JOIN mae_estado me ON ut.idEstado = me.id   ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
