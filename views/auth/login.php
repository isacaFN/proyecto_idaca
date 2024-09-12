<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embutidos IDACA</title>
  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Varela+Round&display=swap" rel="stylesheet">
  
    <link rel="preload" href="build/css/app.css" as="style">
    <link href="build/css/app.css" rel="stylesheet"> 
  </head>

<body>
    <main>  
        <form class="formulario-login" action="/login" method="post">
            <div class="contenedor-formulario">
                <div class="imagen-login">
                    <img src="build/img/idacasvgb.svg" alt="logo">
                 </div>
                 <h3>¡Hola!</h3>
                 <span>Inicia sesión en tu cuenta para ingresar al sistema</span>

                 <div class="contenedor-formulario-input">
                    <input type="text" name="username" placeholder="Correo electronico" required>

                    <input type="password" name="password" placeholder="Contraseña" required>

                    <div class="contenedor-boton">
                        <input class="boton" type="submit" value="Ingresar"">
                    </div>

                    <a href="#">¿Olvidaste tu contraseña?</a> 
                 </div>
            </div>
        </form>
    </main>
</body>