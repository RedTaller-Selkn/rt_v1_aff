<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/variacion/funciones.php");

$query = "  SELECT 
                pv.id, 
                pv.nombre, 
                pv.descripcion, 
                pv.idEstado, 
                me.nombre as estado 
            FROM productovariacion pv 
            INNER JOIN mae_estado me ON pv.idEstado = me.id  ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
