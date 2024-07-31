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
                <th>1</th>
                <th>2</th>
                <th>3</th>
            </tr>
        </table>
    </div>
    </section>
    <div class="stock2">
        <form class="formstock" action="../functions/addstock.php" method="post" >
            <span>agregar Stock</span>
            <label for="codpro">Elige un producto</label>
            <select name="codpro">
            <?php
                for($i = 0; $i < count($nombreProducto); $i++){
                    ?> <option id=<?php $nombreProducto[$i];?>><?php echo $nombreProducto[$i];?></option><?php
                 }
                ?>
            </select> 

            <input name="cant" type="tel" placeholder="cantidad">

            <input type="submit" value="agregar">

        </form>
    </div>