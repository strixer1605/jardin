<?php
    include ('conexion.php');
    $query = "SELECT * FROM novedades WHERE estado = 1 ORDER BY fecha_modif DESC";
    $result = mysqli_query($conexion, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            echo '
            <div class="item">
                <div class="image-container">
                    <img src="../modulos/mostrar_imagen.php?id_noticia=' . $row['id_noticia'] . '">
                </div>
                <div class="info">
                    <div class="info-title">
                        '.$row['titulo_noti'].'
                    </div>
                    '.$row['descripcion_noti'].'
                </div>
            </div>';
        }
    } else {
        echo "No hay noticias disponibles.";
    }
?>
