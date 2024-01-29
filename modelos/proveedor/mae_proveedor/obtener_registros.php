<?php

include("../../../config/conexion.php");
include("../../../controladores/proveedor/mae_proveedor/funciones.php");



$query = "";
$salida = array();
$query = "  SELECT 
                mp.id, 
                mp.nombre, 
                mp.descripcion, 
                mp.razonsocial, 
                mp.rut, 
                mp.giro, 
                mp.direccion, 
                mp.correo, 
                mp.telefono, 
                mp.idproveedortipo, 
                pt.nombre AS proveedortipo, 
                mp.idestado, me.nombre AS estado 
            FROM mae_proveedor mp 
            INNER JOIN mae_estado me ON mp.idestado = me.id 
            INNER JOIN proveedortipo pt ON mp.idproveedortipo = pt.id";

if (isset($_POST["search"]["value"])) {

    $query .= ' WHERE mp.nombre LIKE "%' . $_POST["search"]["value"] . '%"';
    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY' . $_POST['order']['0']['column'] . ' ' .
        $_POST["order"][0]['dir'] . ' ';

    //$query .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%"';
} else {
    $query .= ' ORDER BY mp.id DESC';
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
    //$sub_array[] = $imagen;
    $sub_array = array();
    $sub_array[] = $fila['id'];
    $sub_array[] = $fila['nombre'];
    $sub_array[] = $fila['descripcion'];
    $sub_array[] = $fila['razonsocial'];
    $sub_array[] = $fila['rut'];
    $sub_array[] = $fila['giro'];
    $sub_array[] = $fila['direccion'];
    $sub_array[] = $fila['correo'];
    $sub_array[] = $fila['telefono'];
    $sub_array[] = $fila['idproveedortipo'];
    $sub_array[] = $fila['proveedortipo'];
    $sub_array[] = $fila['idestado'];
    $sub_array[] = $fila['estado'];
    $sub_array[] = ' <button type="button" name="editar" id="' . $fila["id"] . '" class="btn btn-warning btn-xs editar">Editar</button>';
    $sub_array[] = ' <button type="button" name="borrar" id="' . $fila["id"] . '" class="btn btn-danger btn-xs borrar">Borrar</button>';
    $datos[] = $sub_array;
}
$salida = array(
    //"draw"              =>  intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"   =>  get_proveedor(),
    "data"              =>  $datos
);


echo json_encode($salida);
