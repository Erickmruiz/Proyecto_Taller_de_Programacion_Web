<?php
// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$basedatos = 'laclinicabd';


try {
    $pdo = new PDO("mysql:host=localhost;dbname=laclinicabd", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        if (!empty($nombre) && !empty($email) && !empty($contrasena)) {
            $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':contrasena' => $hashedPassword,
            ]);

            // Redirige con éxito
            header("Location: registro.html?status=success");
            exit;
        } else {
            header("Location: registro.html?status=error");
            exit;
        }
    }
} catch (PDOException $e) {
    header("Location: registro.html?status=error");
    exit;
}
