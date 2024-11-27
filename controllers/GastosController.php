<?php
namespace controllers;

use MVC\router;
use Model\Gastos;

class GastosController{
    public static function gastos(router $router){
        // consultar todos los gastos

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gasto = new Gastos($_POST);


            if ($gasto) {
                $resultado = $gasto->guardar();

                if ($resultado) {
                    header('Location: gastos?alert=success');
                }
            }
        }
        $gastos = Gastos::nombreGasto();

        $router->render('gastos/gastos',[
            'gastos' => $gastos
        ]);
    }
}