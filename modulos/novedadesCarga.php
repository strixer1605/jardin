<?php
    include('conexion.php');

    if (isset($_FILES['data_img']) && $_FILES['data_img']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['data_img']['tmp_name'];
        $fileName = $_FILES['data_img']['name'];
        $fileType = $_FILES['data_img']['type'];
        
        $fileContent = file_get_contents($fileTmpPath);
    } else {
        $fileContent = null;
    }

    $noticia = $_POST['data_noticia'];
    $descripcion = $_POST['data_descripcion'];

    $query = "INSERT INTO novedades (titulo_noti, descripcion_noti, img_noti) VALUES (?, ?, ?)";
    $stmt_insertar = mysqli_prepare($conexion, $query);

    // Vincular parámetros y enviar el contenido del archivo como datos largos
    mysqli_stmt_bind_param($stmt_insertar, "ssb", $noticia, $descripcion, $fileContent);

    // Enviar datos largos (el archivo) al servidor
    mysqli_stmt_send_long_data($stmt_insertar, 2, $fileContent);

    if(mysqli_stmt_execute($stmt_insertar)) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt_insertar);
    mysqli_close($conexion);
?>
