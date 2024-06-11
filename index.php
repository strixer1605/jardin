<?php
    session_start();
    $usuarioLogueado = false;
    if (isset($_SESSION['dni'])) {
        $dniUsuario = $_SESSION['dni'];
        $cargoUsuario = $_SESSION['Cargo'];
        $usuario = $_SESSION['Usuario'];
        $apellido = $_SESSION['Apellido'];
        $usuarioLogueado = true;

        // if ($cargoUsuario != "Directivo") {
        //     header('Location: ../login.php');
        //     exit;
        // }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Jardin 901</title>
</head>
<body>
    
<div id="containerHead">
    <div id="inner-containerHead">
        <div class="d-flex flex-column align-items-center">
            <a id="sessionButton" href="main/login.php" class="btn btn-success">Iniciar sesión</a>
            <a id="logoutLink" href="modulos/logout.php" class="btn btn-danger d-none">Cerrar sesión</a>
        </div>
        <div class="itemHead">
            <a href="#"><img src="imagenes/libro.png" class="imgBtnHead" alt="Novedades"></a>
            <p class="spanHead">NUESTRA HISTORIA</p>
        </div>
    </div>
</div>
<div id="container">
    <div id="inner-container">
        <div class="item" style="background-color: #006837;">
            <a href="#"><img src="imagenes/profesora.png" class="imgBtn" alt="Novedades"></a>
            <p class="span">NOVEDADES</p>
        </div>
        <div class="item" style="background-color: #f1db3a;">
            <a href="#"><img src="imagenes/familia.png" class="imgBtn" alt="Actividades"></a>
            <p class="span">ACTIVIDADES</p>
        </div>
        <div class="item" style="background-color: #ef601e;">
            <a href="#"><img src="imagenes/fotografia.png" class="imgBtn" alt="Galeria"></a>
            <p class="span">GALERIA</p>
        </div>
        <div class="item" style="background-color: #6432b7;">
            <a href="#"><img src="imagenes/piezas.png" class="imgBtn" alt="Salitas"></a>
            <p class="span">SALITAS</p>
        </div>
        <div class="item" style="background-color: #e9765b;">
            <a href="#"><img src="imagenes/chicos.png" class="imgBtn" alt="Proyectos"></a>
            <p class="span">PROYECTOS</p>
        </div>
        <div class="item" style="background-color: #e51d1d;">
            <a href="#"><img src="imagenes/calendario.png" class="imgBtn" alt="Calendario"></a>
            <p class="span">CALENDARIO</p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Y5HcW1cXlFY1oBoOlO8HnNQ8VHqC" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const usuarioLogueado = <?php echo json_encode($usuarioLogueado); ?>;
        const usuario = <?php echo json_encode($usuario); ?>;
        const apellido = <?php echo json_encode($apellido); ?>;
        
        if (usuarioLogueado) {
            const sessionButton = document.getElementById('sessionButton');
            sessionButton.textContent = `Bienvenido ${usuario} ${apellido}`;
            sessionButton.classList.remove('btn-success');
            // sessionButton.classList.add('btn-primary');
            sessionButton.href = "";
            
            const logoutLink = document.getElementById('logoutLink');
            logoutLink.classList.remove('d-none');
        }
    });
</script>
</body>
</html>
