<div class="contenedor-usuarios">

        <h2>Crear Usuario</h2>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario-usuarios" action="crearusuario" method="post">
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo s($usuario->nombre); ?>" >

        <input type="text" name="apellido" placeholder="Apellido" value="<?php echo s($usuario->apellido); ?>">

        <input type="email" name="correo" placeholder="Correo electronico" value="<?php echo s($usuario->correo); ?>">

        <input type="password" name="password" placeholder="Contraseña">

        <div class="contenedor-nivel">
            <label for="nivel">Nivel: </label>
            <select name="nivel">
                <option >seleciona un nivel</option>
                <option value="1">Administrador</option>
                <option value="2">Vendedor</option>
                <option value="3">Chofer</option>
            </select>
        </div>

        <div class="contenedor-boton">
            <input class="boton" type="submit" value="Crear">
        </div>
    </form>
</div> 