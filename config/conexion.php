<?php

namespace Config;

class ConexionDDBB
{
    public function conectar()
    {
        $usuario = "root";
        //$usuario ="selkncl_rt"; 
        $clave = "";
        //$clave ="selkn202312";
        return new \PDO('mysql:host=localhost;dbname=bbdd_rrtt', $usuario, $clave);
        //$conexion = new PDO('mysql:host=localhost;dbname=selkncl_rt_ddbb',$usuario,$clave);
    }
}
