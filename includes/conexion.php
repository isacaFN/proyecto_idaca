<?php
$servername = "localhost";
$database = "idaca";
$username = "root";
$password = "";
// Create connection
$db = new mysqli($servername, $username, $password, $database);
// Check connection
if ($db->connect_errno) {
    die("Connection failed: " . mysqli_connect_error());
    echo 'conexion fallida';
    exit();
}

?>