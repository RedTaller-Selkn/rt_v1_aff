<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/variacion/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if(isset($_POST['id'])){
    $salida = array();
    $stmt = $conexion->prepare("SELECT 
                                    pv.id, 
                                    pv.nombre, 
                                    pv.descripcion, 
                                    pv.idEstado, 
                                    me.nombre as estado 
                                FROM productovariacion pv 
                                INNER JOIN mae_estado me ON pv.idEstado = me.id  
                                WHERE id = '".$_POST["id"]."' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    foreach($resultado as $fila){
        $salida['id'] = $fila['id'];
        $salida['nombre'] = $fila['nombre'];
        $salida['descripcion'] = $fila['descripcion'];
        $salida['idEstado'] = $fila['idEstado']; 
        $salida['estado'] = $fila['estado']; 
    }
    echo json_encode($salida);
}