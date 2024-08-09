       <div>
            <?php
                require_once 'head.html';
                require_once 'navegacion.html'; 
                if (isset($_GET['alert'])) {
                    echo 'El usuario no existe';
                }
            ?>
        </div>


    <main >

        <section>
        <br><br><br>
            <form class="formulario sombra" action="../functions/buscar.php" method="post">
                <fieldset>
                    <legend>Buscar cliente</legend>
                    <div class="contenedor-campos">
                        <div class="campo">
                            <label for="ci">cedula o ID</label>
                            <input name="ci" class="input-estilo" type="text" placeholder="ingresa cedula o id de cliente">
                        </div>

                    <div class="flex alinear-derecha">
                        <input class="boton with100" type="submit" value="buscar">
                    </div>

                </fieldset>

            </form>
        </section>
    </main>
</body>

</html>