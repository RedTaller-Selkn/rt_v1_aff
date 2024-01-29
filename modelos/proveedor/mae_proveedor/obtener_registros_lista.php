<?php

include("../../../config/conexion.php");
include("../../../controladores/proveedor/mae_proveedor/funciones.php");

$query = "  SELECT 
                mp.id, 
                mp.nombre, 
                mp.descripcion, 
                mp.razonsocial, 
                mp.rut, mp.giro, 
                mp.direccion, 
                mp.correo, 
                mp.telefono, 
                mp.idproveedortipo, 
                pt.nombre AS proveedortipo, 
                mp.idestado, 
                me.nombre AS estado 
            FROM mae_proveedor mp 
            INNER JOIN mae_estado me ON mp.idestado = me.id 
            INNER JOIN proveedortipo pt ON mp.idproveedortipo = pt.id  ";

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

echo json_encode($resultado);
