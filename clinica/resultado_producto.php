<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laclinicabd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener filtros
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta SQL para obtener productos
$sql = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.cantidad, p.imagen, p.estado, c.nombre_categoria, m.nombre_marca 
        FROM productos p 
        JOIN categorias c ON p.id_categoria = c.id_categoria 
        JOIN marcas m ON p.id_marca = m.id_marca 
        WHERE p.estado = 'A'";

if ($categoria != '') {
    $sql .= " AND c.nombre_categoria = '$categoria'";
}
if ($search != '') {
    $sql .= " AND p.nombre LIKE '%$search%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Productos</title>
    <link rel="stylesheet" href="styles.css"> <!-- Cambia este nombre por tu archivo de estilos -->
</head>
<body>

<header>
    <a href="#">Atención al Cliente: 971 708 349 &gt;&gt; Términos y Condiciones Delibery &gt;&gt; Garantía</a>
    <span style="float:right;">Correo: laclinicadelinformatico@gmail.com</span>
</header>

<nav class="navbar">
    <a href="index.html">
        <img src="Imagenes/laclinica.png" alt="La Clínica del Informático"> <!-- Imagen del logo -->
    </a>

    <div class="cart">
        <div style="display: flex; align-items: center;">
            <a href="iniciar sesion.html" class="btn btn-login">Iniciar Sesión</a>
            <span class="separator">|</span>
            <a href="registro.html" class="btn btn-register">Registrarse</a>
            <?php
            session_start();
            $cart_count = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
            ?>
            <div class="cart">
                <a href="ver_carrito.php" class="btn cart-btn" target="_blank"> 
                    <img src="Imagenes/carrito.png" alt="Carrito">
                    <div class="cart-count" id="cartCount"><?php echo $cart_count; ?></div>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Menú de navegación superior con desgloses -->
<nav class="top-menu">
    <div class="left-links">
        <a href="marcas.html">MARCAS BUSCADAS &#9662;</a>
        <a href="servicio tecnico.html">SERVICIO TÉCNICO PERSONALIZADO</a>
    </div>

    <div class="right-links">
        <a href="Sobre nosotros.html">SOBRE NOSOTROS</a>
        <a href="index.html" class="inicio-link">
            <img src="Imagenes/casa.png" alt="Inicio"> <!-- Imagen al lado de INICIO -->INICIO
        </a>
    </div>
</nav>

<!-- Formulario de búsqueda y filtro -->
<form method="GET" action="resultado_producto.php" class="filter-form">
    <!-- Combo box para el filtro de categoría -->
    <div class="form-group">
        <label for="categoria">Filtrar por categoría:</label>
        <select name="categoria" id="categoria">
            <option value="">Seleccione una categoría</option>
            <option value="Laptops">Laptops</option>
            <option value="Desktops">Desktops</option>
            <option value="Accesorios">Accesorios</option>
            <option value="Componentes">Componentes</option>
        </select>
    </div>

    <!-- Text box para búsqueda -->
    <div class="form-group">
        <label for="search">Buscar producto:</label>
        <input type="text" name="search" id="search" placeholder="Buscar producto...">
    </div>

    <button type="submit" class="submit-btn">Buscar</button>
</form>

<h1>Resultados de Productos</h1>

<div class="product-list">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "' class='product-image'>";
            echo "<h2>" . $row['nombre'] . "</h2>";
            echo "<p><strong>Marca:</strong> " . $row['nombre_marca'] . "</p>";
            echo "<p><strong>Categoría:</strong> " . $row['nombre_categoria'] . "</p>";
            echo "<p><strong>Precio:</strong> S/" . $row['precio'] . "</p>";
            echo "<p>" . $row['descripcion'] . "</p>";

            // Botón de agregar al carrito
            echo "<form method='POST' action='agregar_carrito.php'>";
            echo "<input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>";
            echo "<input type='hidden' name='nombre' value='" . $row['nombre'] . "'>";
            echo "<input type='hidden' name='precio' value='" . $row['precio'] . "'>";
            echo "<button type='submit' class='add-to-cart-btn' title='Agregar este producto al carrito'>Agregar al Carrito</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron productos.</p>";
    }

    $conn->close();
    ?>
</div>
</body>
</html>


<!-- Marcas en la parte inferior -->
<div class="brand-logos">
    <img src="Imagenes/acer.png" alt="Logo Acer" class="brand-logo" data-id="6">
    <img src="Imagenes/asus.png" alt="Logo Asus" class="brand-logo" data-id="2">
    <img src="Imagenes/canon.png" alt="Logo Canon" class="brand-logo" data-id="5">
    <img src="Imagenes/epson.png" alt="Logo Epson" class="brand-logo" data-id="4">
</div>

<!-- Botón de WhatsApp -->
<div class="whatsapp-btn">
    <a href="https://wa.me/51974707700" target="_blank" id="whatsapp-button" class="whatsapp-button">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1200px-WhatsApp.svg.png" alt="WhatsApp" />
        <span>Atención por WhatsApp</span> <!-- Agregar el texto al lado del ícono -->
    </a>
</div>

</body>
</html>
