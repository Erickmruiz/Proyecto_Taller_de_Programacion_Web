<?php
include "conexion.php"; // Archivo de conexión a la base de datos.

if (isset($_GET['query'])) {
    $query = trim($_GET['query']); // Obtén el término de búsqueda.
    $query = $conn->real_escape_string($query); // Escapa los caracteres especiales.

    // Consulta la base de datos.
    $sql = "SELECT nombre_producto, precio, descripcion, imagen 
            FROM productos 
            WHERE nombre_producto LIKE ? OR marca LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$query%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Formatea los resultados como un array.
    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    // Devuelve los resultados como JSON.
    echo json_encode($productos);
} else {
    echo json_encode(["error" => "No se recibió ningún término de búsqueda."]);
}
?>
