<div class="confirmacion">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <?php if($key === 'error'){ ?>
            <a href="login">Salir</a>
        <?php
        }else{ ?>
            <a href="login">Haz click aquí para iniciar sesión</a>
        <?php }?>
        <img src="../public/build/img/login.png" alt="login">
</div>