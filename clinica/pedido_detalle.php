<?php
include 'conexion.php'; // Conexión a la base de datos

// Obtener el ID del pedido desde la URL
$id_pedido = isset($_GET['id_pedido']) ? $_GET['id_pedido'] : null;

if (!$id_pedido) {
    echo "No se encontró un ID de pedido válido.";
    exit;
}

// Consultar los datos del pedido
$sql_pedido = "SELECT * FROM Pedidos WHERE id_pedido = '$id_pedido'";
$result_pedido = $conn->query($sql_pedido);
$pedido = $result_pedido->fetch_assoc();

if (!$pedido) {
    echo "No se encontró información para el pedido.";
    exit;
}

// Consultar los detalles del pedido
$sql_detalles = "SELECT * FROM Detalles_Pedido WHERE id_pedido = '$id_pedido'";
$result_detalles = $conn->query($sql_detalles);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido</title>
    <link rel="stylesheet" href="css/cart-details.css">
</head>
<body>
    <div class="container">
        <h1>Detalle del Pedido</h1>
        <p><strong>Número de Pedido:</strong> <?php echo $pedido['id_pedido']; ?></p>
        <p><strong>Nombre del Cliente:</strong> <?php echo $pedido['nombre_cliente']; ?></p>
        <p><strong>Correo:</strong> <?php echo $pedido['correo']; ?></p>
        <p><strong>Método de Pago:</strong> <?php echo $pedido['metodo_pago']; ?></p>
        <p><strong>Fecha del Pedido:</strong> <?php echo $pedido['fecha_pedido']; ?></p>
        <p><strong>Total:</strong> <?php echo number_format($pedido['total'], 2); ?></p>

        <h2>Productos</h2>
        <table border="1">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
            <?php while ($detalle = $result_detalles->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $detalle['nombre_producto']; ?></td>
                <td><?php echo $detalle['cantidad']; ?></td>
                <td><?php echo number_format($detalle['precio'], 2); ?></td>
                <td><?php echo number_format($detalle['subtotal'], 2); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <button onclick="window.close();">Cerrar</button>
    </div>
</body>
</html>
