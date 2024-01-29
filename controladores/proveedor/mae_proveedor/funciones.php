<?php

function get_proveedor()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
                                    mp.id, 
                                    mp.nombre, 
                                    mp.descripcion, 
                                    mp.razonsocial, 
                                    mp.rut, 
                                    mp.giro, 
                                    mp.direccion, 
                                    mp.correo, 
                                    mp.telefono, 
                                    mp.idproveedortipo, 
                                    pt.nombre as proveedortipo, 
                                    mp.idestado, 
                                    me.nombre as estado 
                                FROM mae_proveedor mp 
                                INNER JOIN mae_estado me ON mp.idestado = me.id 
                                INNER JOIN proveedortipo pt ON mp.idproveedortipo = pt.id");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
