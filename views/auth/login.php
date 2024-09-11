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
                 
                    <input type="text" name="username" placeholder="Usuario" required>
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <input type="submit" value="Ingresar">
            </div>
        </form>
    </main>
</body>