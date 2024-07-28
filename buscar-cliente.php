<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Embutidos IDACA</title>

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
        <div>
            <?php
                if (isset($_GET['alert'])) {
                    echo 'El usuario no existe';
                }
            ?>
        </div>


    <main >

        <section>
        <br><br><br>
            <form class="formulario sombra" action="buscar.php" method="post">
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