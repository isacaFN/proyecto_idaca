<?php
    require_once '../includes/app.php';

use controllers\ApiController;
use controllers\ClienteController;
    use controllers\LoginController;
    use controllers\UsuarioController;
    use MVC\router;
    use controllers\VentaController;

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

    // Api Usuarios
    $router->get('proyecto_idaca/public/api/usuarios', [ApiController::class, 'apiUsuarios']);
    // api clientes
    $router->get('proyecto_idaca/public/api/clientes', [ApiController::class, 'apiClientes']);
    //api productos
    $router->get('proyecto_idaca/public/api/productos', [ApiController::class, 'apiProductos']);
    
    // crear usuarios(administrador, vendedor, chofer)
    $router->get('proyecto_idaca/public/crearusuario', [UsuarioController::class, 'crearUsuario']);
    $router->post('proyecto_idaca/public/crearusuario', [UsuarioController::class, 'crearUsuario']); 

    // rutas clientes
    $router->get('proyecto_idaca/public/clientes', [ClienteController::class, 'clientes']);
    $router->get('proyecto_idaca/public/crearCliente', [ClienteController::class, 'crearCliente']);
    $router->post('proyecto_idaca/public/crearCliente', [ClienteController::class, 'crearCliente']);

    // rutas ventas
    $router->get('proyecto_idaca/public/ventas', [VentaController::class, 'ventas']);
    $router->get('proyecto_idaca/public/crearVenta', [VentaController::class, 'crearVenta']);
    $router->post('proyecto_idaca/public/verificarVenta', [VentaController::class, 'verificarVenta']);



    // Comprobar rutas
    $router->comprobarRutas();

?>