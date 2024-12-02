<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos
$cart = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_cliente = $_POST['nombre_cliente'];
    $correo = $_POST['correo'];
    $metodo_pago = $_POST['metodo_pago'];

    // Calcular el total del carrito
    foreach ($cart as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // Generar el nuevo ID de pedido
    $sql_id = "SELECT MAX(CAST(id_pedido AS UNSIGNED)) AS ultimo_id FROM Pedidos";
    $result_id = $conn->query($sql_id);
    $nuevo_id = '0001'; // Valor inicial si no hay registros

    if ($result_id->num_rows > 0) {
        $row_id = $result_id->fetch_assoc();
        if ($row_id['ultimo_id'] !== null) {
            $nuevo_id = str_pad($row_id['ultimo_id'] + 1, 4, '0', STR_PAD_LEFT);
        }
    }

    // Insertar el pedido en la tabla Pedidos
    $sql_pedido = "INSERT INTO Pedidos (id_pedido, nombre_cliente, correo, metodo_pago, fecha_pedido, total, estado)
                   VALUES ('$nuevo_id', '$nombre_cliente', '$correo', '$metodo_pago', NOW(), '$total', 'Pendiente')";

    if ($conn->query($sql_pedido) === TRUE) {
        // Insertar los detalles del pedido en la tabla Detalles_Pedido
        foreach ($cart as $item) {
            $id_producto = $item['id_producto'];
            $nombre_producto = $item['nombre'];
            $precio = $item['precio'];
            $cantidad = $item['cantidad'];
            $subtotal = $precio * $cantidad;

            $sql_detalle = "INSERT INTO Detalles_Pedido (id_pedido, id_producto, nombre_producto, precio, cantidad, subtotal)
                            VALUES ('$nuevo_id', '$id_producto', '$nombre_producto', '$precio', '$cantidad', '$subtotal')";

            $conn->query($sql_detalle);
        }

        // Vaciar el carrito
        unset($_SESSION['carrito']);

        // Redirigir a una nueva pestaña para mostrar el detalle del pedido
        echo "<script>
                alert('¡Compra finalizada con éxito! A tu correo llegarán las instrucciones de cómo realizar el pago de tu pedido.');
                window.location.href = 'pedido_detalle.php?id_pedido=$nuevo_id'; // Redirige al inicio o a otra página después de cerrar
              </script>";
    } else {
        echo "Error al procesar el pedido: " . $conn->error;
    }
    // Cerrar la conexión
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="css/cart-details.css">
</head>
<body>
    <div class="container">
        <h1>Finalizar Compra</h1>

        <form action="checkout.php" method="POST" class="form-checkout">
            <label for="nombre_cliente">Nombre Completo</label>
            <input type="text" id="nombre_cliente" name="nombre_cliente" required>

            <label for="correo">Correo Electrónico</label>
            <input type="email" id="correo" name="correo" required>

            <label for="metodo_pago">Método de Pago</label>
            <select id="metodo_pago" name="metodo_pago" required>
                <option value="transferencia">Transferencia Bancaria</option>
                <option value="efectivo">Efectivo</option>
            </select>

            <h2>Resumen de tu Pedido</h2>
            <table class="table-details">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item) : ?>
                    <tr>
                        <td><?php echo $item['nombre']; ?></td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td><?php echo number_format($item['precio'], 2); ?></td>
                        <td><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?php echo number_format($total, 2); ?></td>
                    </tr>
                </tfoot>
            </table>

            <button type="submit">Finalizar Compra</button>
        </form>
    </div>
</body>
</html>
