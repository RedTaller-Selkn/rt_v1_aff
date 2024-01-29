<?php

include("../../../config/conexion.php");
include("../../../controladores/stock/egreso/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST['id'])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT 
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
                                INNER JOIN stockestado se ON si.idstockestado = se.id  
                                WHERE si.id = '" . $_POST["id"] . "' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $salida['id']               = $fila['id'];
        $salida['nombre']           = $fila['nombre'];
        $salida['descripcion']      = $fila['descripcion'];
        $salida['numero']           = $fila['numero'];
        $salida['cantidadtotal']    = $fila['cantidadtotal'];
        $salida['costototal']       = $fila['costototal'];
        $salida['iva']              = $fila['iva'];
        $salida['idusuario']        = $fila['idusuario'];
        $salida['fechaegreso']     = $fila['fechaegreso'];
        $salida['idstocktipo']      = $fila['idstocktipo'];
        $salida['stocktipo']        = $fila['stocktipo'];
        $salida['idstockestado']    = $fila['idstockestado'];
        $salida['stockestado']      = $fila['stockestado'];

    }
    echo json_encode($salida);
}
