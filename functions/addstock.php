<?php 
	require_once("conexion.php");

$producto = $_POST['codpro'];
$cantidad = $_POST['cant'];

$query_select = "SELECT * FROM producto WHERE nomprod =  '$producto'";
$resultado = $conn->query($query_select);

       if($resultado->num_rows > 0){
           $fila = mysqli_fetch_array( $resultado );
           $codp = $fila['codproducto'];
       }else{
           echo 'error al generar venta';
       }

$query_insert = "INSERT INTO stock (idproducto, , nombre, cantactual ) VALUES ('$codp', '$producto', '$$cantidad ')";

$resultado = $conn->query($query_insert);

if($resultado > 0) {
    header('location: crear.php?alert=2');
}
$conn->close();
?>
?>