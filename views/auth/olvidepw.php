<body class="body-olvidepw">
<main class="contenedor-olvidepw">
    <div class="imagen-olvidepw">
        <img src="../public/build/img/logoidaca.jpg">
    </div>
    <div class="formulario-olvidepw">
        <h2>Introduzca su correo</h2>
        <p>Por favor Ingresa tu correo electronico para recibir instrucciones</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <form class="olvidepw" action="olvidepw" method="post">
            <input type="email" name="correo">
            <input class="boton" type="submit" value="Enviar Intrucciones">

        </form>

        <a href="login">Iniciar sesión</a>
    </div>
</main>