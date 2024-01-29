<?php

include("../../../config/conexion.php");
include("../../../controladores/ubicacion/ubicacion/funciones.php");

$query = "  SELECT 
                ub.id, 
                ub.nombre, 
                ub.descripcion, 
                ub.direccion, 
                ub.idubicaciontipo, 
                ut.nombre as ubicaciontipo, 
                ub.idestado, 
                me.nombre as estado 
            FROM ubicacion ub 
            INNER JOIN mae_estado me ON ub.idestado = me.id 
            INNER JOIN ubicaciontipo ut ON ub.idubicaciontipo = ut.id ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);