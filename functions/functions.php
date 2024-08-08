<?php 

function nombreProducto() : array {

    require_once("conexion.php");

    $query_select = "SELECT nomprod FROM producto";
    $resultado = $conn->query($query_select);

    if($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_array(MYSQLI_ASSOC)){
            $nombreProducto[] = $fila["nomprod"];
        }

        return $nombreProducto;

        $conn->close();
    }
}
