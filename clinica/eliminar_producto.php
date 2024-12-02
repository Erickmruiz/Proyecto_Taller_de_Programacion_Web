<?php
session_start();

// Verificar si se recibió un producto a eliminar
if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    // Eliminar el producto del carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        unset($_SESSION['carrito'][$id_producto]);
    }

    // Redirigir de nuevo al carrito
    header("Location: ver_carrito.php");
    exit();
}
?>
