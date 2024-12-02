<?php
// Inicia la sesión para manejar el carrito de compras
session_start();
// Obtiene el carrito de la sesión o inicializa uno vacío si no existe
$cart = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;
// Calcula el total sumando el precio de cada producto por su cantidad
foreach ($cart as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Procesa la eliminación de un producto cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $productoAEliminar = $_POST['producto'];
    foreach ($cart as $index => $item) {
        if ($item['nombre'] === $productoAEliminar) {
            unset($cart[$index]);
            $_SESSION['carrito'] = array_values($cart);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/cart-details.css">
</head>
<body>


    <div class="container">
        <h1>Tu Carrito de Compras</h1>
         <!-- Muestra la tabla si el carrito no está vacío -->
        <?php if (!empty($cart)) : ?>
        <table class="table-cart">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorre el carrito y muestra cada producto -->
                <?php foreach ($cart as $item) : ?>
                <tr>
                    <td><?php echo $item['nombre']; ?></td>
                    <td><?php echo $item['cantidad']; ?></td>
                    <td><?php echo number_format($item['precio'], 2); ?></td>
                    <td><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                    <td>
                        <!-- Formulario para eliminar el producto -->
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="producto" value="<?php echo $item['nombre']; ?>">
                            <button type="submit" name="eliminar" class="btn-delete">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <!-- Muestra el total del carrito -->
                <tr>
                    <td colspan="4" style="text-align: right;">Total</td>
                    <td><?php echo number_format($total, 2); ?></td>
                </tr>
            </tfoot>
        </table>
         <!-- Botón para finalizar la compra -->
        <button onclick="window.location.href='checkout.php'" class="btn">Finalizar Compra</button>
        <?php else : ?>
        <p>Tu carrito está vacío.</p>
        <button onclick="window.close()" class="btn-close">Cerrar Pestaña</button>
        <?php endif; ?>
    </div>
</body>
</html>
