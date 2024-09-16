<?php

namespace controllers;

use MVC\router;

class LoginController{
    public static function login(router $router){
        $router->render('auth/login');
        
    }

    public static function logout(){
        echo 'desde logout';
    }

    public static function olvidepw(router $router){
        $router->render('auth/olvidepw', [

        ]);
    }

    public static function recuperar(){
        echo 'desde recuperar';
    }

    public static function crear(){
        echo 'desde crear';
    }
}