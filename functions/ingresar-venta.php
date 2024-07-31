<?php
session_start();
require_once("conexion.php");

$ci = $_SESSION['ci'];
$producto = $_POST['codpro'];
$tventa = $_POST['tven']; 
$cantidad = $_POST['cant'];
$query_select = "SELECT * FROM producto WHERE nomprod =  '$producto'";
$resultado = $conn->query($query_select);

       if($resultado->num_rows > 0){
           $fila = mysqli_fetch_array( $resultado );
           $precio = $fila['precio'] * $_POST['cant'];
           $codp = $fila['codproducto'];
       }else{
           echo 'error al generar venta';
       }
//        function optenerCodigo(string $producto): int
//        {
//            return match(true){
//            $producto == "chuleta" => "1",
//            $producto == "chorizo ahumado" => "2",
//            $producto == "tocineta ahumada" => "3",
//            };
//        }

// $codp = optenerCodigo($producto);
    $query_insert = "INSERT INTO venta (fecha, totalkg, totalpagar, idcliente, codproducto, tipoventa) VALUES (CURRENT_TIMESTAMP(), $cantidad, $precio, $ci, $codp, $tventa)";

    $resultado = $conn->query($query_insert);

    if($resultado > 0) {
        header('location: ../sections/generar-venta.php?alert=2');
    }else{
    }

    $conn->close();
?>