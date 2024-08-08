<?php   
    require_once 'head.html'; 
    require_once 'navegacion.html'; 
    require_once("../functions/conexion.php");
?>

        <main>
                <table class="tabla">
                    <tr>
                        <th class="encabezado">cedula o dni</th>
                        <th class="encabezado">nombre</th>
                        <th class="encabezado">Telefono</th>
                        <th class="encabezado">Correo electronico</th>
                        <th class="encabezado">Direccion</th>
                    </tr>
                    <?php
                            $sql = "SELECT id, nombre, telefono, correo, direccion FROM clientes";
                            $resul = mysqli_query($conn, $sql);
                    ?>

                    <tr>
                    <?php if(mysqli_num_rows($resul) > 0) {
                        while($fila = mysqli_fetch_assoc($resul)){?>
                        <td><?php echo $fila["id"]; ?></td>
                        <td><?php echo $fila["nombre"]; ?></td>
                        <td><?php echo $fila["telefono"]; ?></td>
                        <td><?php echo $fila["correo"]; ?></td>
                        <td><?php echo $fila["direccion"]; ?></td>

                    </tr>
                    <?php }$conn->close(); }
                    else{
                    };
         
                    ?>
                </table>
                    
        </main>
</body>
</html>