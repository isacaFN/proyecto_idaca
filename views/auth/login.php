<main>  
        <form class="formulario-login" action="proyecto_idaca/public" method="post">
            <div class="contenedor-formulario">
                <div class="imagen-login">
                    <img src="../public/build/img/idacasvgb.svg" alt="logo">
                 </div>
                 <h3>¡Hola!</h3>
                 <span>Inicia sesión en tu cuenta para ingresar al sistema</span>

                 <div class="contenedor-formulario-input">
                    <input type="email" name="username" placeholder="Correo electronico" required>

                    <input type="password" name="password" placeholder="Contraseña" required>

                    <div class="contenedor-boton">
                        <input class="boton" type="submit" value="Ingresar"">
                    </div>

                    <a href="olvidepw">¿Olvidaste tu contraseña?</a> 
                 </div>
            </div>
        </form>
</main>