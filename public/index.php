<?php
    require_once '../includes/app.php';

    use controllers\ApiController;
    use controllers\ClienteController;
    use controllers\LoginController;
    use controllers\UsuarioController;
    use MVC\router;
    use controllers\VentaController;
    use controllers\InventarioController;
    use controllers\dashboardController;
    use controllers\GastosController;

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
    //api tipo de venta 
    $router->get('proyecto_idaca/public/api/tipoventa', [ApiController::class, 'apitipoventa']);
    // api ventas
    $router->get('proyecto_idaca/public/api/ventas', [ApiController::class, 'apiventas']);

    // api ventas totales
    $router->get('proyecto_idaca/public/api/ventasYgastosTotales', [ApiController::class, 'apiventasYgastosTotales']);

    //api producto mas pedido
    $router->get('proyecto_idaca/public/api/productoMasVendido', [ApiController::class, 'apiproductosmaspedido']);

    //api gastos
    $router->get('proyecto_idaca/public/api/gastos', [ApiController::class, 'apigastos']);

    
    // crear usuarios(administrador, vendedor, chofer)
    $router->get('proyecto_idaca/public/crearusuario', [UsuarioController::class, 'crearUsuario']);
    $router->post('proyecto_idaca/public/crearusuario', [UsuarioController::class, 'crearUsuario']); 

    // rutas clientes
    $router->get('proyecto_idaca/public/clientes', [ClienteController::class, 'clientes']);
    $router->get('proyecto_idaca/public/crearCliente', [ClienteController::class, 'crearCliente']);
    $router->post('proyecto_idaca/public/crearCliente', [ClienteController::class, 'crearCliente']);

    // rutas ventas
    $router->get('proyecto_idaca/public/ventas', [VentaController::class, 'ventas']);
    $router->get('proyecto_idaca/public/detalleventa', [VentaController::class, 'detalleventa']);
    $router->get('proyecto_idaca/public/crearVenta', [VentaController::class, 'crearVenta']);
    $router->post('proyecto_idaca/public/verificarVenta', [VentaController::class, 'verificarVenta']);
    $router->get('proyecto_idaca/public/verificarVenta', [VentaController::class, 'verificarVenta']);
    $router->post('proyecto_idaca/public/guardarVenta', [VentaController::class, 'guardarVenta']);

    // ruta inventario
    $router->get('proyecto_idaca/public/inventario', [InventarioController::class, 'inventario']);
    $router->post('proyecto_idaca/public/inventario', [InventarioController::class, 'inventario']);

    // ruta dashboard    
    $router->get('proyecto_idaca/public/dashboard', [dashboardController::class, 'dashboard']);

    // ruta gastos
    $router->get('proyecto_idaca/public/gastos', [GastosController::class, 'gastos']);
    $router->post('proyecto_idaca/public/gastos', [GastosController::class, 'gastos']);



    // Comprobar rutas
    $router->comprobarRutas();

?>