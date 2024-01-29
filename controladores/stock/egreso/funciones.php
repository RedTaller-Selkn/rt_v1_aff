<?php

function get_egreso()
{
    $conexion = new \Config\ConexionDDBB();
    $cliente = $conexion->conectar();
    $stmt = $cliente->prepare(" SELECT 
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
                                INNER JOIN stockestado se ON si.idstockestado = se.id");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
