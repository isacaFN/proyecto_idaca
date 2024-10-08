<section class="contenedor-lista-usuarios">
        <h1>Clientes</h1>
        <table class="tabla">
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>nombre</th>
                    <th>telefono</th>
                    <th>correo electronico</th>
                    <th>direccion</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($clientes as $cliente):
                ?>
                <tr>
                    <td><?php echo $cliente->id; ?></td>
                    <td><?php echo $cliente->nombre; ?></td>
                    <td><?php echo $cliente->telefono; ?></td>
                    <td><?php echo $cliente->correo; ?></td>
                    <td><?php echo $cliente->direccion; ?></td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="link-nuevo-usuario">
            <a href="crear-cliente" >Crear nuevo cliente</button>
        </div>

</section>