<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embutidos IDACA</title>
  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Varela+Round&display=swap" rel="stylesheet">
  
    <link rel="preload" href="../public/build/css/app.css" as="style">
    <link href="../public/build/css/app.css" rel="stylesheet"> 
  </head>
  <body>
    <?php if(!$login){ ?>
        <div class="header">
            <nav class="contenido-header">
                <div>
                  <a href="menup.php">
                    <img src="../public/build/img/logoidaca.jpg">
                  </a>
                </div>
                <div class="links">
                  <a href="/login">iniciar sesion</a>
                  <a href="buscar-cliente.php">Generar venta</a>
                  <a href="ventas.php">Ver ventas</a>
                  <a href="clientes.php">Clientes</a>
                  <a href="crear.php">Crear Cliente</a>
                  <a href="inventario.php">Ver inventario</a>
                </div>
            </nav>
        </div>
    <?php } 

    echo $contenido; ?>
            
</html>