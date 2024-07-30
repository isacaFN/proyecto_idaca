<?php   
        require_once("templates/navegacion.html");
    	require_once("conexion.php");
?>

        <main>
            <?php
                $sql = "SELECT * from clientes";
                $resul = mysqli_query($conn, $sql);
             ?>
            <form class="formulario sombra" method="post">
                <div class="contenedor-campos">
                    <div class="campo">
                        <label for="ventas">Elige un Cliente</label>
                            <select name="ventas">
                                <?php if(mysqli_num_rows($resul) > 0) {
                                        while($fila = mysqli_fetch_assoc($resul)){?> 
                                <option id="<?php $fila["nombre"];?>"><?php echo $fila["nombre"];?></option>
                                <?php }}?>
                                <option  value="todas">Ver todas las ventas</option>
                            </select>
                    </div>
                </div>

                <div class="flex alinear-derecha">
                        <input class="boton with100" type="submit" value="Buscar">
                </div>
            </form>

            <?php 
                $mostrartodos = false;
                $seleccion = false;


                if (empty($_POST['ventas'])) {  
                    }else{

                    if($_POST['ventas'] == "todas"){
                        $mostrartodos = true;
                        $seleccion = true;

                    }else{
                        $sql = "SELECT id, nombre from clientes";
                        $resul = mysqli_query($conn, $sql);

                    
    
                        if(mysqli_num_rows($resul) > 0) {
                            while($fila = mysqli_fetch_assoc($resul)){
                                if($_POST['ventas'] == $fila["nombre"]){ 
                                    $mostrarnombre = $fila["id"];
                                    $seleccion = true;
                                    $mostrartodos = false;
                                    break;
                                }
                            }
                        }
                    }
                }
        if($seleccion == true){ ?>
            <br><br>
            <div class="contenedort">
                <table class="tabla">
                    <tr>
                        <th>fecha</th>
                        <th>nombre</th>
                        <th>producto</th>
                        <th>total kg</th>
                        <th>total pagado</th>
                    </tr>
                    <?php
                        if($mostrartodos == true){
                            $sql = "SELECT fecha, nombre, totalkg, totalpagar, nomprod FROM venta INNER JOIN clientes on venta.idcliente=clientes.id INNER JOIN producto on venta.codproducto=producto.codproducto";
                            $resul = mysqli_query($conn, $sql);
                        }
                        else{
                            $sql = "SELECT fecha, nombre, totalkg, totalpagar, nomprod FROM venta INNER JOIN clientes on venta.idcliente=clientes.id INNER JOIN producto on venta.codproducto=producto.codproducto where venta.idcliente = $mostrarnombre";
                            $resul = mysqli_query($conn, $sql);
                        }

                        if(mysqli_num_rows($resul) > 0) {
                        while($fila = mysqli_fetch_assoc($resul)){?>

                    <tr>
                        <td><?php echo $fila["fecha"]; ?></td>
                        <td><?php echo $fila["nombre"]; ?></td>
                        <td><?php echo $fila["nomprod"]; ?></td>
                        <td><?php echo $fila["totalkg"]; ?></td>
                        <td><?php echo $fila["totalpagar"]; ?></td>

                    </tr>

                    <?php } }  $conn->close();}
                    else{
                    };
         
                    ?>
                </table>
            </div>
                    
        </main>
</body>
</html>