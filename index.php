<?php

use PSpell\Config;

require_once "controladores/plantilla.controlador.php";
//require_once "config/conexion.php";

$plantilla = new PlantillaControlador();
$plantilla->plantilla();

