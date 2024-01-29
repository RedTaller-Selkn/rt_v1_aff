<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/mae_producto/funciones.php");

$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

if (isset($_POST['id'])) {
    $salida = array();

    $stmt = $conexion->prepare("SELECT 
                                    p.id as id, 
                                    p.nombre as nombre, 
                                    p.descripcion as descripcion, 
                                    p.codBarra as codBarra, 
                                    p.imagen as imagen, 
                                    p.idUsuario as idUsuario, 
                                    p.idFicha as idFicha, 
                                    p.idTipoCantidad as idTipoCantidad, 
                                    p.idEstado as idEstado, 
                                    e.nombre as estado 
                                FROM producto p
                                INNER JOIN mae_estado e ON p.idEstado=e.id 
                                WHERE p.id = '" . $_POST["id"] . "' LIMIT 1");
    //CATEGORIA - TIPO - Material - MODELO - VARIACION
    $stmt_categoria = $conexion->prepare("SELECT * FROM productocategoria ");
    $stmt_tipo      = $conexion->prepare("SELECT * FROM productotipo ");
    $stmt_material  = $conexion->prepare("SELECT * FROM productomaterial ");
    $stmt_modelo    = $conexion->prepare("SELECT * FROM productomodelo ");
    $stmt_variacion = $conexion->prepare("SELECT * FROM productovariacion ");
    $stmt_estado    = $conexion->prepare("SELECT * FROM mae_estado ");

    $stmt->execute();
    $stmt_categoria->execute();
    $stmt_tipo->execute();
    $stmt_material->execute();
    $stmt_modelo->execute();
    $stmt_variacion->execute();
    $stmt_estado->execute();

    $resultado = $stmt->fetchAll();
    $resultado_categoria    = $stmt_categoria->fetchAll();
    $resultado_tipo         = $stmt_tipo->fetchAll();
    $resultado_material     = $stmt_material->fetchAll();
    $resultado_modelo       = $stmt_modelo->fetchAll();
    $resultado_variacion    = $stmt_variacion->fetchAll();
    $resultado_estado       = $stmt_estado->fetchAll();

    foreach ($resultado as $fila) {
        $salida['id']           = $fila['id'];
        $salida['nombre']       = $fila['nombre'];
        $salida['descripcion']  = $fila['descripcion'];
        $salida['codBarra']     = $fila['codBarra'];
        $salida['imagen']       = $fila['imagen'];
        if ($fila["imagen"] != '') {
            $salida['imagen_producto'] = '<img src="img/productos/' . $fila["imagen"] . '"class="img-thumbnail" width="50" height="50">';
        } else {
            $salida['imagen_producto'] = '';
        }
        $salida['idUsuario'] = $fila['idUsuario'];
        $salida['idFicha'] = $fila['idFicha'];
        $salida['idTipoCantidad'] = $fila['idTipoCantidad'];

        $salida['idCategoria'] = $fila['idCategoria'];
        $salida['idTipo'] = $fila['idTipo'];
        $salida['idMaterial'] = $fila['idMaterial'];
        $salida['idModelo'] = $fila['idModelo'];
        $salida['idVariacion'] = $fila['idVariacion'];

        $salida['idEstado'] = $fila['idEstado'];
        $salida['estado'] = $fila['estado'];
    }

    $salida['categoria'] = $resultado_categoria;
    $salida['tipo'] = $resultado_tipo;
    $salida['material'] = $resultado_material;
    $salida['modelo'] = $resultado_modelo;
    $salida['variacion'] = $resultado_variacion;
    $salida['estados'] = $resultado_estado;
    echo json_encode($salida);
}
