<?php
    // Iniciar sesión si no está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Destruir todas las variables de sesión
    $_SESSION = array();

    // Destruir la sesión
    session_destroy();

    // Redireccionar al usuario a la página de inicio o a donde desees
    header("Location: ../index.php"); // Cambia "index.php" por la URL de tu página principal
    exit();
?>