<?php
$servername = "localhost";
$username = "root";  // Cambia estos valores según tu configuración
$password = "";
$dbname = "laclinicabd";  // Cambia este valor según tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
