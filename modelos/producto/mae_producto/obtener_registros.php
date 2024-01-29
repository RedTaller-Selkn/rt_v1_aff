<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/mae_producto/funciones.php");



$query = "";
$salida = array();
$query = "  SELECT 
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
            INNER JOIN mae_estado e ON p.idEstado=e.id ";

if (isset($_POST["search"]["value"])) {

    $query .= ' WHERE p.nombre LIKE "%' . $_POST["search"]["value"] . '%"';
    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY' . $_POST['order']['0']['column'] . ' ' .
        $_POST["order"][0]['dir'] . ' ';

    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
} else {
    $query .= ' ORDER BY p.id DESC';
}

// if($_POST["length"] != -1){
//     $query .= ' LIMIT' . $_POST["start"] . ',' . $_POST["length"];
// }
$cliente = new \Config\ConexionDDBB();
$conexion = $cliente->conectar();

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

$datos = array();

$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $imagen = '';
    if ($fila["imagen"] != '') {
        $imagen = '<img src="img/productos/' . $fila["imagen"] . '"class="img-thumbnail" width="50" height="35" />';
    } else {
        $imagen = '';
    }
    $sub_array = array();
    $sub_array[] = $fila['id'];
    $sub_array[] = $fila['nombre'];
    $sub_array[] = $fila['descripcion'];
    $sub_array[] = $fila['codBarra'];
    $sub_array[] = $imagen;
    $sub_array[] = $fila['idUsuario'];
    $sub_array[] = $fila['idFicha'];
    $sub_array[] = $fila['idTipoCantidad'];
    $sub_array[] = $fila['idEstado'];
    $sub_array[] = $fila['estado'];
    $sub_array[] = ' <button type="button" name="editar" id="' . $fila["id"] . '" class="btn btn-warning btn-xs editar">Editar</button>';
    $sub_array[] = ' <button type="button" name="borrar" id="' . $fila["id"] . '" class="btn btn-danger btn-xs borrar">Borrar</button>';
    $datos[] = $sub_array;
}
$salida = array(
    //"draw"              =>  intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"   =>  get_productos(),
    "data"              =>  $datos
);


echo json_encode($salida);
