<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/modelo/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST['id'])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT pm.id, 
                                    pm.nombre, 
                                    pm.descripcion, 
                                    pm.idEstado, 
                                    me.nombre as estado 
                                FROM productomodelo pm 
                                INNER JOIN mae_estado me ON pm.idEstado = me.id 
                                WHERE pm.id = '" . $_POST["id"] . "' LIMIT 1");
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
