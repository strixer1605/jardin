<?php
if(isset($_POST['data_dni'], $_POST['data_nombre'], $_POST['data_apellido'], $_POST['data_gmail'], $_POST['data_cargo'])){

    $dni = $_POST['data_dni'];
    $nombre = $_POST['data_nombre'];
    $apellido = $_POST['data_apellido'];
    $gmail = $_POST['data_gmail'];
    $cargo = $_POST['data_cargo'];

    include('conexion.php');

    // Prepara la declaración SQL para evitar inyecciones SQL
    $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, gmail = ?, cargo = ? WHERE dni = ?";
    $stmt = $conexion->prepare($sql);
    if($stmt === false) {
        echo "Error preparando la declaración: " . $conexion->error;
        exit();
    }

    // Bindea las variables a los parámetros de la declaración preparada
    $stmt->bind_param("sssss", $nombre, $apellido, $gmail, $cargo, $dni);

    // Ejecuta la declaración
    if($stmt->execute()) {
        // Verificar si la actualización fue exitosa
        if($stmt->affected_rows > 0) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "No se realizó ninguna actualización.";
        }
    } else {
        echo "Error al actualizar el usuario: " . $stmt->error;
    }

    // Cierra la declaración y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo "Error: El formulario no se envió correctamente.";
}
?>
