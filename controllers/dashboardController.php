<?php

namespace controllers;

use MVC\router;

class dashboardController{
    public static function dashboard(router $router){
        $router->render('dashboard/dashboard');
    }
}