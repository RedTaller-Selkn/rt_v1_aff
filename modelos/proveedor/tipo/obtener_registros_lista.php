<?php

include("../../../config/conexion.php");
include("../../../controladores/proveedor/tipo/funciones.php");

$query = "  SELECT 
                pt.id, 
                pt.nombre, 
                pt.descripcion, 
                pt.idEstado, 
                me.nombre as estado 
            FROM proveedortipo pt 
            INNER JOIN mae_estado me ON pt.idEstado = me.id  ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
