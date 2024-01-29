<?php

include("../../../config/conexion.php");
include("../../../controladores/ubicacion/ubicacion/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST['id'])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT  ub.id, 
                                        ub.nombre, 
                                        ub.descripcion, 
                                        ub.direccion, 
                                        ub.idubicaciontipo, 
                                        ut.nombre as ubicaciontipo, 
                                        ub.idestado, 
                                        me.nombre as estado 
                                FROM ubicacion ub 
                                INNER JOIN mae_estado me ON ub.idestado = me.id 
                                INNER JOIN ubicaciontipo ut ON ub.idubicaciontipo = ut.id  
                                WHERE ub.id = '" . $_POST["id"] . "' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $salida['id']               = $fila['id'];
        $salida['nombre']           = $fila['nombre'];
        $salida['descripcion']      = $fila['descripcion'];
        $salida['direccion']        = $fila['direccion'];
        $salida['idubicaciontipo']  = $fila['idubicaciontipo'];
        $salida['ubicaciontipo']    = $fila['ubicaciontipo'];
        $salida['idestado']         = $fila['idestado'];
        $salida['estado']           = $fila['estado'];
    }
    echo json_encode($salida);
}
