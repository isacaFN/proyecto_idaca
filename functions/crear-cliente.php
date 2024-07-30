<?php 

	require_once("conexion.php");

	$ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];


	//$pw = md5($pw);

	$query_insert = "INSERT INTO clientes (id, nombre, telefono, correo, direccion) VALUES ('$ci', '$nombre', '$telefono', '$correo', '$direccion')";

	$resultado = $conn->query($query_insert);

    if($resultado > 0) {
        header('location: crear.php?alert=2');
    }
    $conn->close();
?>

