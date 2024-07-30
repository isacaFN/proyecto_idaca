<?php
    require_once 'navegacion.html'; 
    require_once '../functions/conexion.php';
    session_start();

?>

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
    <form class="formulario" action="../functions/ingresar-venta.php" method="post">
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
                            <select name="codpro"><?php
                            $query_select = "SELECT nomprod FROM producto";
                            $resultado = $conn->query($query_select);
                            if($resultado->num_rows > 0){
                                while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                                    ?> <option id=<?php $fila['nomprod'];?>><?php echo $fila['nomprod'];?></option><?php
                                }
                            }
                            else{
                                echo "no resulto";
                            }
                            ?>
                            </select>

                                <label for="cant">cantidad kg</label>
                                <input name="cant" class="input-estilo"  type="tel" placeholder="cantidad">

                        </div>

                        <div class="campo">
                            <label for="tven">tipo de venta</label>
                            <select name="tven">
                                    <option value="1">efectivo</option>
                                    <option value="2">transferencia</option>
                                    <option value="3">credito</option>
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