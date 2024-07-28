<?php
    session_start();

?>

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

    <?php
        if (isset($_GET['alert'])) {?>
            <div class="window-notice">
                <div class="content">
                    <div class="campo">Venta Generada con exito</div> 
                    <div class="flex alinear-derecha"><a href="crear.php" class="boton wiht100">Aceptar</a></div>
                </div>
            </div>
       <?php }
    ?>

    <main>
    <br><br><br>
    <form class="formulario" action="ingresar-venta.php" method="post">
                <fieldset>
                    <legend>Rellena los campos para generar la venta</legend>

                    <h2>Cliente:<span>
                    <?php 
                    
                        echo $_SESSION['nombre'];
                    ?>
                    </span>
                    </h2>

                    <br>

                    <div class="contenedor-campos">
                        <div class="campo">
                            <label for="codpro">producto </label>
                            <select name="codpro">
                                    <option  value="chuleta">chuleta</option>
                                    <option  value="chorizo">chorizo ahumado</option>
                                    <option value="tocineta">tocineta ahumada</option>
                            </select>

                                <label for="cant">cantidad kg</label>
                                <input name="cant" class="input-estilo"  type="tel" placeholder="cantidad">

                        </div>
                    
                        <!-- <div class="campo">
                            <label for="codpro1">producto </label>
                            <select name="codpro1">
                                    <option value="chuleta">chuleta</option>
                                    <option value="chorizo">chorizo ahumado</option>
                                    <option value="tocineta">tocineta ahumada</option>
                            </select>

                                <label for="cant1">cantidad kg</label>
                                <input name="cant1" class="input-estilo"  type="tel" placeholder="cantidad">

                        </div>

                        <div class="campo">
                            <label for="codpro2">producto </label>
                            <select name="codpro2">
                                    <option value="chuleta">chuleta</option>
                                    <option value="chorizo">chorizo ahumado</option>
                                    <option value="tocineta">tocineta ahumada</option>
                            </select>

                                <label for="cant2">cantidad kg</label>
                                <input name="cant2" class="input-estilo"  type="tel" placeholder="cantidad">

                        </div> -->

                        <div class="campo">
                            <label for="tven">tipo de venta</label>
                            <select name="tven">
                                    <option value="efec">efectivo</option>
                                    <option value="trans">transferencia</option>
                                    <option value="cred">credito</option>
                            </select>
                        </div>

                    </div>

                    <div class="flex alinear-derecha">
                        <input class="boton with100" type="submit" value="generar venta">
                    </div>

                </fieldset>

            </form>
        </section>
    </main>
</body>
</html> 