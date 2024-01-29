<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/marca/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST['id'])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT 
                                    m.id, 
                                    m.nombre, 
                                    m.descripcion, 
                                    m.idEstado, 
                                    me.nombre AS estado 
                                FROM marca m 
                                INNER JOIN mae_estado me ON m.idEstado=me.id 
                                WHERE m.id = '" . $_POST["id"] . "' LIMIT 1");
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
