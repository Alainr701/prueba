<?php
session_start();
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eispdm_sistema";

// Establecer conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
//mostrar si la conexion es exitosa
if (!$conn) {
    echo("Connection failed: " . mysqli_connect_error());
}
// else{
//     echo "Conexion exitosa";
// }

?>
