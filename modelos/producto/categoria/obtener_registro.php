<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/categoria/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST['id'])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT 
                                    pc.id, 
                                    pc.nombre, 
                                    pc.descripcion, 
                                    pc.idEstado, 
                                    me.nombre as estado 
                                FROM productocategoria pc 
                                INNER JOIN mae_estado me ON pc.idEstado = me.id 
                                WHERE pc.id = '" . $_POST["id"] . "' LIMIT 1");
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
