<?php
session_start();

// Conexión a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'laravel';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consulta para verificar las credenciales
$sql = "SELECT * FROM usuarios WHERE correo = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['contraseña'])) {
        // Credenciales correctas, crear una sesión
        $_SESSION['nombre'] = $row['nombre']; 
        header('Location: dashboard.php'); // Redireccionar al panel de control o página de inicio
    } else {
        // Contraseña incorrecta, redireccionar al formulario de inicio de sesión con un mensaje de error
        header('Location: login.php?error=1');
    }
} else {
    // Correo electrónico no encontrado, redireccionar al formulario de inicio de sesión con un mensaje de error
    header('Location: login.php?error=1');
}
$conn->close();

?>