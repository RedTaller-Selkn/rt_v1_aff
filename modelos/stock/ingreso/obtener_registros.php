<?php

include("../../../config/conexion.php");
include("../../../controladores/stock/ingreso/funciones.php");

$query = "";
$salida = array();
$query = "  SELECT 
                si.id, 
                si.nombre, 
                si.descripcion, 
                si.ordencompra, 
                si.cantidadtotal, 
                si.costototal, 
                si.iva, 
                si.idusuario, 
                si.fechaingreso, 
                si.idstocktipo,
                st.nombre AS stocktipo,
                si.idstockestado,
                se.nombre AS stockestado
            FROM stockingresos si
            INNER JOIN stocktipo st ON si.idstocktipo = st.id
            INNER JOIN stockestado se ON si.idstockestado = se.id  ";

if(isset($_POST["search"]["value"])){
    
    $query .= ' WHERE si.nombre LIKE "%' . $_POST["search"]["value"] . '%"';
    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
}

if(isset($_POST["order"])){
    $query .= ' ORDER BY' . $_POST['order']['0']['column'] . ' ' .
    $_POST["order"][0]['dir'] . ' ';

    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
} else {
    $query .= ' ORDER BY si.id DESC';
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
    $sub_array[] = $fila['ordencompra'];
    $sub_array[] = $fila['cantidadtotal'];
    $sub_array[] = $fila['costototal'];
    $sub_array[] = $fila['iva'];
    $sub_array[] = $fila['idusuario'];
    $sub_array[] = $fila['fechaingreso'];
    $sub_array[] = $fila['idstocktipo'];
    $sub_array[] = $fila['stocktipo'];
    $sub_array[] = $fila['idstockestado'];
    $sub_array[] = $fila['stockestado'];
    $sub_array[] = ' <button type="button" name="editar" id="' .$fila["id"]. '" class="btn btn-warning btn-xs editar">Editar</button>';
    $sub_array[] = ' <button type="button" name="detalle" id="' .$fila["id"]. '" class="btn btn-success btn-xs editar">Detalle</button>';
    $sub_array[] = ' <button type="button" name="borrar" id="' .$fila["id"]. '" class="btn btn-danger btn-xs borrar">Borrar</button>';
    $datos[] = $sub_array;
}
$salida = array(
    //"draw"              =>  intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"   =>  get_ingreso(),
    "data"              =>  $datos
);


echo json_encode($salida);