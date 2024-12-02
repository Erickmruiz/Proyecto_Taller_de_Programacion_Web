<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laclinicabd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$search = $_GET['query'] ?? ''; // Obtener el término de búsqueda
$search = $conn->real_escape_string($search);

// Consultar productos por marca o nombre
$sql = "SELECT * FROM laptops WHERE nombre LIKE '%$search%' OR marca LIKE '%$search%'";
$result = $conn->query($sql);

$laptops = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $laptops[] = $row;
    }
}

echo json_encode($laptops);

$conn->close();
?>
