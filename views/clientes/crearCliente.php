<div class="contenedor-usuarios">

        <h2>Crear Cliente</h2>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario-usuarios" action="crearCliente" method="post">
        
        <input type="number" name="dni" placeholder="rut o dni" value="<?php echo s($cliente->dni); ?>" >
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo s($cliente->nombre); ?>" >
        <input type="number" name="telefono" placeholder="Telefono" value="<?php echo s($cliente->telefono); ?>" >
        <input type="email" name="correo" placeholder="Correo electronico" value="<?php echo s($cliente->correo); ?>">
        <input type="text" name="direccion" placeholder="direccion" value="<?php echo s($cliente->direccion); ?>">


        <div class="contenedor-boton">
            <input class="boton" type="submit" value="Crear">
        </div>
    </form>
</div> 