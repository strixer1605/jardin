<?php
    include('conexion.php');

    if(isset($_GET['id_noticia'])) {
        $id = $_GET['id_noticia'];

        // Consulta para obtener la imagen desde la base de datos
        $query = "SELECT img_noti FROM novedades WHERE id_noticia = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $imagen);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        header('Content-Type: image/png');
        echo $imagen;
    } else {
        echo "Error: Identificador de imagen no proporcionado.";
    }
    mysqli_close($conexion);
?>
