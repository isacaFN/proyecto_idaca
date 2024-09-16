<?php
    require_once '../includes/app.php';

    use controllers\LoginController;
    use MVC\router;

    $router = new router();

    $router->get('proyecto_idaca/public', [LoginController::class, 'login']);
    $router->post('proyecto_idaca/public', [LoginController::class, 'login']);
    $router->get('proyecto_idaca/public/logout', [LoginController::class, 'logout']);

    //recuperar password
    $router->get('proyecto_idaca/public/olvidepw', [LoginController::class, 'olvidepw']);
    $router->post('proyecto_idaca/public/olvidepw', [LoginController::class, 'olvidepw']);
    $router->get('proyecto_idaca/public/recuperar', [LoginController::class, 'recuperar']);
    $router->post('proyecto_idaca/public/recuperar', [LoginController::class, 'recuperar']);

    //crear usuario
    //$router->get('/crear', [LoginController::class, 'crear']);
    //$router->post('/crear', [LoginController::class, 'crear']);

    // Comprobar rutas
    $router->comprobarRutas();

?>