<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol de admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: iniciar_sesion.html");
    exit();
}

require_once 'conexion.php'; // Archivo que contiene la conexión a la base de datos

// Obtener los datos del formulario
$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productPrice = $_POST['productPrice'];

// Validar datos del formulario
if (empty($productName) || empty($productCategory) || !is_numeric($productPrice) || $productPrice <= 0) {
    die("Datos del producto no válidos.");
}

// Subir la imagen
$imageTmpName = $_FILES['productImage']['tmp_name'];
$imageName = basename($_FILES['productImage']['name']);
$imageSize = $_FILES['productImage']['size'];
$imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

// Verificar si el archivo es una imagen válida
if (!in_array($imageType, ['jpg', 'jpeg', 'png'])) {
    die("Solo se permiten imágenes JPG, JPEG y PNG.");
}

// Verificar el tamaño del archivo (limitar a 2MB)
if ($imageSize > 2 * 1024 * 1024) {
    die("El archivo es demasiado grande. El tamaño máximo es 2MB.");
}

// Mover el archivo a la carpeta de destino
$imagePath = 'uploads/' . $imageName;
if (!move_uploaded_file($imageTmpName, $imagePath)) {
    die("Error al subir la imagen.");
}

// Insertar el producto en la base de datos
$query = "INSERT INTO productos (nombre, categoria, precio, imagen) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssds", $productName, $productCategory, $productPrice, $imagePath);

if ($stmt->execute()) {
    // Redirigir al panel de administración después de agregar el producto
    header("Location: cp_panel.php");
    exit();
} else {
    echo "Error al agregar el producto: " . $stmt->error;
}
?>
