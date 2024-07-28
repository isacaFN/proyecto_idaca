<?php   
    require_once("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embutidos Idaca</title>

    <link rel="stylesheet" href="css/normalize.css">

    <link rel="preload" href="css/style.css" as="style">
    <link href="css/style.css" rel="stylesheet"> 

</head>
<body>

    <header class="titulo">
                <h1>Embutidos IDACA</h1>
    </header>

            <div class="fondo-nav">
                <nav class="navegacion contenedor">
                    <a href="buscar-cliente.php">Generar venta</a>
                    <a href="ventas.php">Ver ventas</a>
                    <a href="clientes.php">Clientes</a>
                    <a href="crear.php">Crear Cliente</a>
                </nav>
            </div>

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