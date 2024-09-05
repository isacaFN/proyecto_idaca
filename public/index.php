<?php
    require_once '../includes/app.php';

use controllers\LoginController;
use MVC\router;

    $router = new router();

    $router->get('/', [LoginController::class, 'login']);
    $router->post('/', [LoginController::class, 'login']);
    $router->get('/logout', [LoginController::class, 'logout']);

    //recuperar password
    $router->get('/olvidepw', [LoginController::class, 'olvidepw']);
    $router->post('/olvidepw', [LoginController::class, 'olvidepw']);
    $router->get('/recuperar', [LoginController::class, 'recuperar']);
    $router->post('/recuperar', [LoginController::class, 'recuperar']);

    //crear usuario
    $router->get('/crear', [LoginController::class, 'crear']);
    $router->post('/crear', [LoginController::class, 'crear']);



    // Comprobar rutas
    $router->comprobarRutas();

?>