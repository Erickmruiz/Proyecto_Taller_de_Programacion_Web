<?php
include "conexion.php";

$marca_id = isset($_GET['marca_id']) ? intval($_GET['marca_id']) : 0;

if ($marca_id > 0) {
    $stmt = $conn->prepare("SELECT nombre_producto, precio, descripcion, imagen FROM productos WHERE marca_id = ?");
    $stmt->bind_param("i", $marca_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    echo json_encode($productos);
} else {
    echo json_encode(["error" => "Marca no válida."]);
}
?>
