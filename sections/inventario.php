<?php 
require_once 'navegacion.html'; 
require_once("../functions/conexion.php");
?>

<h2>Stock Actual</h2>
<section class="stock"> 
    <div> 
        <table class="tabla">
        <?php 
            $query_select = "SELECT nomprod FROM producto";
            $resultado = $conn->query($query_select);
            ?><tr><?php
            if($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_array(MYSQLI_ASSOC)){?> 
                <th><?php echo $fila["nomprod"];?></th>
                <?php $nombreProducto[] = $fila["nomprod"];}} $conn->close()?>
            </tr>

            <tr>
            </tr>
        </table>
    </div>

    <div>
        <form class="formulario sombra" action="../functions/addstock.php" method="post" >
            <h2>Agregar Stock</h2>
            <label for="codpro">Elige un producto</label>
            <select name="codpro">
            <?php
                for($i = 0; $i < count($nombreProducto); $i++){
                    ?> <option id=<?php $nombreProducto[$i];?>><?php echo $nombreProducto[$i];?></option><?php
                 }
                ?>
            </select> 

            <input name="cant" class="input-estilo"  type="tel" placeholder="cantidad">

            <input class="boton with100" type="submit" value="agregar">

        </form>
    </div>

</section>