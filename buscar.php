<?php 
    session_start();
	require_once("conexion.php");

    $ci = $_POST['ci'];

    $query_select = "SELECT * FROM clientes WHERE id = '$ci'";

    $resultado = $conn->query($query_select);

    if($resultado->num_rows > 0){
        $_SESSION['ci'] = $_POST['ci'];

        $fila = mysqli_fetch_array( $resultado );
        $_SESSION['nombre'] = $fila['nombre'];

        header('location: generar-venta.php');
    }
    else{
        header('location: buscar-cliente.php?alert=2');
    }
    $conn->close();

?>