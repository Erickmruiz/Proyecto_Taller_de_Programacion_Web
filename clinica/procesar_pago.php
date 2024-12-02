<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombre_cliente = $_POST['nombre_cliente'];
    $direccion = $_POST['direccion'];
    $metodo_pago = $_POST['metodo_pago'];
    $total = 0;

    // Calcular el total del carrito
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }

    // Guardar la información del pedido (esto sería en una base de datos real)
    // Aquí solo simulamos un mensaje de éxito
    echo "<h1>Gracias por tu compra, $nombre_cliente</h1>";
    echo "<p>Total pagado: $" . number_format($total, 2) . "</p>";
    echo "<p>Se enviará tu pedido a la dirección: $direccion</p>";
    echo "<p>Método de Pago: " . htmlspecialchars($metodo_pago) . "</p>";

    // Vaciar el carrito después del pago
    unset($_SESSION['carrito']);
} else {
    header('Location: index.php');
    exit();
}
?>
