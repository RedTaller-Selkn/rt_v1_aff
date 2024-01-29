<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/categoria/funciones.php");

$query = "  SELECT 
                pc.id, 
                pc.nombre, 
                pc.descripcion, 
                pc.idEstado, 
                me.nombre as estado 
            FROM productocategoria pc 
            INNER JOIN mae_estado me ON pc.idEstado = me.id ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
