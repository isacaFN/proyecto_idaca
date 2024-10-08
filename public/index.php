<?php
    require_once '../includes/app.php';
    use controllers\ClienteController;
    use controllers\LoginController;
    use controllers\UsuarioController;
    use MVC\router;

    $router = new router();
    //home
    $router->get('proyecto_idaca/public/home', [LoginController::class, 'home']);

    // login
    $router->get('proyecto_idaca/public', [LoginController::class, 'login']);
    $router->get('proyecto_idaca/public/login', [LoginController::class, 'login']);
    $router->post('proyecto_idaca/public/login', [LoginController::class, 'login']);
    $router->get('proyecto_idaca/public/logout', [LoginController::class, 'logout']);

    //recuperar password
    $router->get('proyecto_idaca/public/olvidepw', [LoginController::class, 'olvidepw']);
    $router->post('proyecto_idaca/public/olvidepw', [LoginController::class, 'olvidepw']);
    $router->get('proyecto_idaca/public/recuperar', [LoginController::class, 'recuperar']);
    $router->post('proyecto_idaca/public/recuperar', [LoginController::class, 'recuperar']);

    // confirmar registro de usuario
    $router->get('proyecto_idaca/public/confirmar-registro', [UsuarioController::class, 'confirmarRegistro']);
    $router->get('proyecto_idaca/public/mensaje', [UsuarioController::class, 'mensaje']);

    // de aqui para abajo todo es privado
    //vista usuarios
    $router->get('proyecto_idaca/public/usuarios', [UsuarioController::class, 'usuarios']);
    
    // crear usuarios
    $router->get('proyecto_idaca/public/crearusuario', [UsuarioController::class, 'crearUsuario']);
    $router->post('proyecto_idaca/public/crearusuario', [UsuarioController::class, 'crearUsuario']);

    // rutas clientes
    $router->get('proyecto_idaca/public/clientes', [ClienteController::class, 'clientes']);
    $router->get('proyecto_idaca/public/crear-cliente', [ClienteController::class, 'crearCliente']);
    $router->post('proyecto_idaca/public/crear-cliente', [ClienteController::class, 'crearCliente']);


    // Comprobar rutas
    $router->comprobarRutas();

?>