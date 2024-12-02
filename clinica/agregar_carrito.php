<?php
session_start();

// Verificar si se recibió el producto
if (isset($_POST['id_producto'], $_POST['nombre'], $_POST['precio'])) {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    // Crear el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Verificar si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto]['cantidad'] += 1; // Incrementar cantidad
    } else {
        $_SESSION['carrito'][$id_producto] = [
            'id_producto' => $id_producto,
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => 1
        ];
    }

    echo "<script>alert('Producto agregado al carrito'); window.history.back();</script>";
} else {
    echo "Error: No se recibieron datos del producto.";
}
?>
