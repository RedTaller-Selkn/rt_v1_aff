<?php

include("../../../config/conexion.php");
include("../../../controladores/proveedor/tipo/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST['id'])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT 
                                    pt.id, 
                                    pt.nombre, 
                                    pt.descripcion, 
                                    pt.idEstado, 
                                    me.nombre as estado 
                                FROM proveedortipo pt 
                                INNER JOIN mae_estado me ON pt.idEstado = me.id  
                                WHERE pt.id = '" . $_POST["id"] . "' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    foreach ($resultado as $fila) {
        $salida['id'] = $fila['id'];
        $salida['nombre'] = $fila['nombre'];
        $salida['descripcion'] = $fila['descripcion'];
        $salida['idEstado'] = $fila['idEstado'];
        $salida['estado'] = $fila['estado'];
    }
    echo json_encode($salida);
}
