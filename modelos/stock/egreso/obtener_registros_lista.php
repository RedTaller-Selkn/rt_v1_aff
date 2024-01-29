<?php

include("../../../config/conexion.php");
include("../../../controladores/stock/egreso/funciones.php");

$query = "  SELECT 
                si.id, 
                si.nombre, 
                si.descripcion, 
                si.numero, 
                si.cantidadtotal, 
                si.costototal, 
                si.iva, 
                si.idusuario, 
                si.fechaegreso, 
                si.idstocktipo,
                st.nombre AS stocktipo,
                si.idstockestado,
                se.nombre AS stockestado
            FROM stockegresos si
            INNER JOIN stocktipo st ON si.idstocktipo = st.id
            INNER JOIN stockestado se ON si.idstockestado = se.id   ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);