<?php 
require_once 'navegacion.html'; 
require_once("../functions/conexion.php");
?>

<h2>Stock Actual</h2>
<section class="stock"> 
    <div> 
        <table class="tabla">
        <?php 
            $sql = "SELECT nomprod from producto";
            $resul = mysqli_query($conn, $sql);
            ?><tr><?php
            if(mysqli_num_rows($resul) > 0) {
            while($fila = mysqli_fetch_assoc($resul)){?> 
                <th><?php echo $fila["nomprod"];?></th>
                <?php }}?>
            </tr>

            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
            </tr>
        </table>
    </div>

    <div>
        <form class="formulario sombra" action="../functions/addstock.php" method="post" >
            <h2>Agregar Stock</h2>
            <label for="codpro">Elige un producto</label>
            <select name="codpro">
            <?php
            while($fila = mysqli_fetch_assoc($resul)){?> 
                <option id="<?php $fila["nomprod"];?>"><?php echo $fila["nomprod"];?></option>
            <?php } $conn->close();?>
            </select>

            <label for="cant">cantidad en kg</label>
            <input name="cant" class="input-estilo"  type="tel" placeholder="cantidad">

            <input class="boton with100" type="submit" value="Buscar">

        </form>
    </div>

</section>