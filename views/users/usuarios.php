<section class="contenedor-lista-usuarios">
<h1>Usuarios</h1>
    <table class="tabla">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo electronico</th>
                <th>Nivel</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($usuarios as $usuario):
            ?>
            <tr>
                <td><?php echo $usuario->nombre; ?></td>
                <td><?php echo $usuario->apellido; ?></td>
                <td><?php echo $usuario->correo; ?></td>
                <td><?php echo $usuario->nivel; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="link-nuevo-usuario">
        <a href="crearusuario" >Crear nuevo usuario</button>
    </div>

</section>
