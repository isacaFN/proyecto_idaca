<?php   
        require_once 'head.html'; 
        require_once 'navegacion.html'; 
        if (isset($_GET['alert'])) {?>
            <div class="window-notice">
                <div class="content">
                    <div class="campo">Cliente guardado con exito</div> 
                    <div class="flex alinear-derecha"><a href="crear.php" class="boton wiht100">Aceptar</a></div>
                </div>
            </div>
<?php }
?>
        
    <main>
    
        <section>
            <br><br><br>
            <form class="formulario sombra" action="../functions/crear-cliente.php" method="post">
                <fieldset>
                    <legend>llena todos los campos para crear el cliente</legend>
                    <div class="contenedor-campos">
                        <div class="campo">
                            <label for="ci">Cedula o ID</label>
                            <input class="input-estilo" name="ci" type="text" placeholder="ingresa un id" required>
                        </div>

                        <div class="campo">
                            <label for="nombre">nombre</label>
                            <input class="input-estilo" name="nombre" type="text" placeholder="tu nombre" required>
                        </div>

                        <div class="campo">
                            <label for="telefono">Telefono</label>
                            <input class="input-estilo"  name="telefono" type="tel" placeholder="telefono de contacto">
                        </div>

                        <div class="campo">
                            <label for="correo">Correo</label>
                            <input class="input-estilo" name="correo" type="email" placeholder="correo electronico">
                        </div>

                        <div class="campo">
                            <label for="direccion">direccion</label>
                            <input class="input-estilo" name="direccion" type="text" placeholder="direccion"> 
                        </div>
                    </div> 

                        <div class="flex alinear-derecha">
                            <input class="boton with100" type="submit" value="Enviar">
                        </div>

                </fieldset>

            </form>
        </section>
    </main>
    
</body>
</html>