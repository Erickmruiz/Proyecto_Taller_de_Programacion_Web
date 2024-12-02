<?php
include "conexion.php";

$result = $conn->query("SELECT id, nombre FROM marcas");

$marcas = [];
while ($row = $result->fetch_assoc()) {
    $marcas[] = $row;
}

echo json_encode($marcas);
?>
