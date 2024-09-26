<main>  
        <div class="contenedor-login">
        <form class="formulario-login" action="login" method="post">
            <div class="contenedor-formulario">
                 <h3>¡Hola!</h3>
                 <span>Inicia sesión en tu cuenta para ingresar al sistema</span>

                 <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

                 <div class="contenedor-formulario-input">
                    <input type="email" name="correo" placeholder="Correo electronico" >

                    <input type="password" name="password" placeholder="Contraseña">

                    <div class="contenedor-boton">
                        <input class="boton" type="submit" value="Ingresar"">
                    </div>

                    <a href="olvidepw">¿Olvidaste tu contraseña?</a> 
                    
                 </div>
            </div>
        </form>
        
        <div class="imagen-login">
            <img src="../public/build/img/login.png" alt="banner login">
        </div>

    </div>
</main>