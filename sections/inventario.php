<?php 
require_once 'head.html'; 
require_once 'navegacion.html'; 
require_once("../functions/functions.php");

$nomPro = nombreProducto();
?>

<h2>Stock Actual</h2>
<section class="stock"> 
    <div> 
        <table class="tabla">
            <tr><?php
            for($i = 0; $i < count($nomPro); $i++){ ?>
                <th><?php echo $nomPro[$i];}?></th> 
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
                for($i = 0; $i < count($nomPro); $i++){
                    ?> <option id=<?php $nomPro[$i];?>><?php echo $nomPro[$i];?></option><?php
                 }
                ?>
            </select> 

            <input name="cant" type="tel" placeholder="cantidad">

            <input type="submit" value="agregar">

        </form>
    </div>