<?php

include("../../../config/conexion.php");
include("../../../controladores/proveedor/mae_proveedor/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST['id'])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT 
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
                                INNER JOIN proveedortipo pt ON mp.idproveedortipo = pt.id 
                                WHERE mp.id = '" . $_POST["id"] . "' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    foreach ($resultado as $fila) {
        $salida['id']               = $fila['id'];
        $salida['nombre']           = $fila['nombre'];
        $salida['descripcion']      = $fila['descripcion'];
        $salida['razonsocial']      = $fila['razonsocial'];
        $salida['rut']              = $fila['rut'];
        $salida['giro']             = $fila['giro'];
        $salida['direccion']        = $fila['direccion'];
        $salida['correo']           = $fila['correo'];
        $salida['telefono']         = $fila['telefono'];
        $salida['idproveedortipo']  = $fila['idproveedortipo'];
        $salida['proveedortipo']    = $fila['proveedortipo'];
        $salida['idestado']         = $fila['idestado'];
        $salida['estado']           = $fila['estado'];
    }
    echo json_encode($salida);
}
