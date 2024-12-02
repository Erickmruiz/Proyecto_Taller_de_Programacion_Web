<?php
// Configuración de conexión a la base de datos
$host = "localhost";
$dbname = "laclinicabd";
$user = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Obtener parámetros de la URL
$category = $_GET['category'] ?? '';
$marca = $_GET['marca'] ?? '';

if ($category && $marca) {
    // Consulta SQL segura usando parámetros preparados
    $query = $pdo->prepare("SELECT * FROM productos WHERE categoria = :categoria AND marca LIKE :marca");
    $query->execute([
        ':categoria' => $category,
        ':marca' => '%' . $marca . '%'
    ]);

    // Devolver los resultados en formato JSON
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
} else {
    // Si no se envían parámetros, devolver un array vacío
    echo json_encode([]);
}
?>
