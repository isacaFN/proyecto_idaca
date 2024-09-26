<body class="body-olvidepw">
<main class="contenedor-olvidepw">
    <div class="imagen-olvidepw">
        <img src="../public/build/img/logoidaca.jpg">
    </div>
    <div class="formulario-olvidepw">
        <h2>Restablecer contraseña</h2>
        <p>A continuacion ingresa tu nueva contraseña</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <?php if($error){ return; }?>
        <form class="olvidepw" method="post">
            <input type="password" name="password" placeholder="Nueva Contraseña">
            <input class="boton" type="submit" value="Guardar contraseña">
        </form>

        <a href="login">Iniciar sesión</a>
    </div>
</main>