<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/material/funciones.php");



$query = "";
$salida = array();
$query = "  SELECT 
                pm.id, 
                pm.nombre, 
                pm.descripcion, 
                pm.idEstado, 
                me.nombre as estado  
            FROM productomaterial pm 
            INNER JOIN mae_estado me ON pm.idEstado = me.id  ";

if (isset($_POST["search"]["value"])) {

    $query .= ' WHERE pm.nombre LIKE "%' . $_POST["search"]["value"] . '%"';
    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY' . $_POST['order']['0']['column'] . ' ' .
        $_POST["order"][0]['dir'] . ' ';

    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
} else {
    $query .= ' ORDER BY pm.id DESC';
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
    $sub_array = array();
    $sub_array[] = $fila['id'];
    $sub_array[] = $fila['nombre'];
    $sub_array[] = $fila['descripcion'];
    $sub_array[] = $fila['idEstado'];
    $sub_array[] = $fila['estado'];
    $sub_array[] = ' <button type="button" name="editar" id="' . $fila["id"] . '" class="btn btn-warning btn-xs editar">Editar</button>';
    $sub_array[] = ' <button type="button" name="borrar" id="' . $fila["id"] . '" class="btn btn-danger btn-xs borrar">Borrar</button>';
    $datos[] = $sub_array;
}
$salida = array(
    //"draw"              =>  intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"   =>  get_productosMaterial(),
    "data"              =>  $datos
);


echo json_encode($salida);
