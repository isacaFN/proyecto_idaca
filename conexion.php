<?php
$servername = "localhost";
$database = "idaca";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_errno) {
    die("Connection failed: " . mysqli_connect_error());
    echo 'conexion fallida';
}

?>