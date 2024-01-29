<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/marca/funciones.php");

$query = "  SELECT 
                m.id, 
                m.nombre, 
                m.descripcion, 
                m.idEstado, 
                me.nombre AS estado 
            FROM marca m 
            INNER JOIN mae_estado me ON m.idEstado=me.id ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
