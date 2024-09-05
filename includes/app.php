<?php 

    require_once 'conexion.php';
    require 'funciones.php';
    require __DIR__ . '/../vendor/autoload.php';

    use Model\ActiveRecord;

    ActiveRecord::setDB($db);
