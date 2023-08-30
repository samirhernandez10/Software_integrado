<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<head>
    <title>Panel de Control</title>
    
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Panel de Control</h1>
        </div>
        <div class="content">
            <?php
            session_start();

            // Verificar si hay un mensaje de registro exitoso
            if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso']) {
                echo '<div class="welcome-message">¡Registro exitoso! Bienvenido al dashboard.</div>';
                // Limpiar la variable de sesión después de mostrar el mensaje
                unset($_SESSION['registro_exitoso']);
            }
            ?>
            <h2>Bienvenido al Panel de Control</h2>
            <p>Hola, <?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'invitado'; ?></p>
            <a href="logout.php" class="logout-button">Cerrar sesión</a>
        </div>
        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> Software Integrado</p>
        </div>
    </div>
</body>
</html>