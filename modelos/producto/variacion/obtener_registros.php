<?php

include("../../../config/conexion.php");
include("../../../controladores/producto/variacion/funciones.php");



$query = "";
$salida = array();
$query = "  SELECT 
                pv.id, 
                pv.nombre, 
                pv.descripcion, 
                pv.idEstado, 
                me.nombre as estado 
            FROM productovariacion pv 
            INNER JOIN mae_estado me ON pv.idEstado = me.id  ";

if(isset($_POST["search"]["value"])){
    
    $query .= ' WHERE pv.nombre LIKE "%' . $_POST["search"]["value"] . '%"';
    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
}

if(isset($_POST["order"])){
    $query .= ' ORDER BY' . $_POST['order']['0']['column'] . ' ' .
    $_POST["order"][0]['dir'] . ' ';

    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
} else {
    $query .= ' ORDER BY pv.id DESC';
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
foreach($resultado as $fila){
    //$sub_array[] = $imagen;
    $sub_array = array();
    $sub_array[] = $fila['id'];
    $sub_array[] = $fila['nombre'];
    $sub_array[] = $fila['descripcion'];
    $sub_array[] = $fila['idEstado']; 
    $sub_array[] = $fila['estado']; 
    $sub_array[] = ' <button type="button" name="editar" id="' .$fila["id"]. '" class="btn btn-warning btn-xs editar">Editar</button>';
    $sub_array[] = ' <button type="button" name="borrar" id="' .$fila["id"]. '" class="btn btn-danger btn-xs borrar">Borrar</button>';
    $datos[] = $sub_array;
}
$salida = array(
    //"draw"              =>  intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"   =>  get_productosVariacion(),
    "data"              =>  $datos
);


echo json_encode($salida);