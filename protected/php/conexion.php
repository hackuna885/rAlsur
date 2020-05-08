<?php

    class Conexion{
        public static function Conectar(){

            $opciones = array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION => 'SET NAMES utf8');

            try{
                $conexion = new PDO("sqlite:../data/riesgos.db");
                return $conexion;
            }catch (Exception $e){
                die("El problema de Conexión es: ". $e->getMessage());
            }
        }
    }

?>