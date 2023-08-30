<?php
// Conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laravel";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// Obtener los datos del formulario
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
// Verificar si el correo electrónico ya está en uso
$sql_check_email = "SELECT * FROM usuarios WHERE correo = '$email'";
$result_check_email = $conn->query($sql_check_email);
if ($result_check_email->num_rows > 0) {
    echo "El correo electrónico ya está en uso.";
    // Puedes redirigir o mostrar un mensaje de error aquí
} else {
    // Insertar el nuevo usuario en la base de datos
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash de la contraseña
    $sql_insert_user = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql_insert_user) === TRUE) {
        // Almacenar un mensaje en una variable de sesión
        session_start();
        $_SESSION['registro_exitoso'] = true;
        // Redirigir al usuario al dashboard o panel del software después de un registro exitoso
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
        // mostrar un mensaje de error aquí
    }
}
$conn->close();
// Cerrar la conexión
?>