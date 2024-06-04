<?php 
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];
    $nuevaContraseña = $_POST['nuevaContraseña'];

    // Hash de la nueva contraseña
    $hashedPassword = password_hash($nuevaContraseña, PASSWORD_DEFAULT);

    // Preparar y ejecutar la consulta
    $query = "UPDATE usuarios SET contraseña= ? WHERE dni= ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ss", $hashedPassword, $dni);
    $stmt->execute();

    // Redirigir al usuario
    header("Location: ../login.php?message=success_password");
} else {
    header("Location: ../login.php?message=error");
}

$conexion->close();
?>
