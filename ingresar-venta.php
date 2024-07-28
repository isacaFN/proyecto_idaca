<?php
session_start();
require_once("conexion.php");

$ci = $_SESSION['ci'];


 $producto = $_POST['codpro'];

/* $producto2 = $_POST['codpro1'];
 $producto3 = $_POST['codpro2']; */
 $cantidad = $_POST['cant'];
 $tventa = $_POST['tven']; 

    if($_POST['codpro'] == "chuleta"){

        $query_select = "SELECT * FROM producto WHERE nomprod = 'chuleta'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal1 = $precio * $_POST['cant'];
            $codp = 1;
        }else{
            echo 'error al buscar';
        }

    }else if($_POST['codpro'] == "chorizo"){
        $query_select = "SELECT * FROM producto WHERE nomprod = 'chorizo ahumado'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal1 = $precio * $_POST['cant']; 
            $codp = 2;     
        }else{
            echo 'error al buscar';
        }
    }else{
        $query_select = "SELECT * FROM producto WHERE nomprod = 'tocineta ahumada'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal1 = $precio * $_POST['cant'];
            $codp = 3;
        }else{
            echo 'error al buscar';
        }
    }
/*
    if($_POST['codpro1'] == "chuleta"){
        $query_select = "SELECT * FROM producto WHERE nomprod = 'chuleta'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal2 = $precio * $_POST['cant1'];
        }else{
            echo 'error al buscar';
        }

    }else if($_POST['codpro1'] == "chorizo"){
        $query_select = "SELECT * FROM producto WHERE nomprod = 'chorizo ahumado'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal2 = $precio * $_POST['cant1'];
        }else{
            echo 'error al buscar';
        }
    }else{
        $query_select = "SELECT * FROM producto WHERE nomprod = 'tocineta ahumada'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal2 = $precio * $_POST['cant1'];
        }else{
        }
    }

    if($_POST['codpro2'] == "chuleta"){
        $query_select = "SELECT * FROM producto WHERE nomprod = 'chuleta'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal3 = $precio * $_POST['cant2'];
        }else{
            echo 'error al buscar';
        }

    }else if($_POST['codpro2'] == "chorizo"){
        $query_select = "SELECT * FROM producto WHERE nomprod = 'chorizo ahumado'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal3 = $precio * $_POST['cant2'];
        }else{
            echo 'error al buscar';
        }
    }else{
        $query_select = "SELECT * FROM producto WHERE nomprod = 'tocineta ahumada'";

        $resultado = $conn->query($query_select);

        if($resultado->num_rows > 0){
            $fila = mysqli_fetch_array( $resultado );
            $precio = $fila['precio'];
            $preciofinal3 = $precio * $_POST['cant2'];
        }else{
            echo 'error al buscar';
        }
    }
*/

    if($tventa == "efec"){
        $tventa = 1; 
    }

    if($tventa == "trans"){
        $tventa = 2; 
    }

    if($tventa == "cred"){
        $tventa = 3; 
    }

    $query_insert = "INSERT INTO venta (fecha, totalkg, totalpagar, idcliente, codproducto, tipoventa) VALUES (CURRENT_TIMESTAMP(), $cantidad, $preciofinal1, $ci, $codp, $tventa)";

	$resultado = $conn->query($query_insert);

    if($resultado > 0) {
        header('location: generar-venta.php?alert=2');
    }else{
    }

    $conn->close();
?>