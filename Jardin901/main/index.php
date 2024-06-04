<?php
    session_start();
    if (isset($_SESSION['dni'])) {
        $dniUsuario = $_SESSION['dni'];
        $cargoUsuario = $_SESSION['Cargo'];
        
        if ($cargoUsuario != "Directivo") {
            header('Location: ../login.php');
            exit;
        }
    } else {
        header('Location: ../login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <title>Jardin 901</title>
    <style>
        /* CSS incluido aquí para conveniencia */
        .navbar {
            background-color: rgb(64, 165, 221);
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 170px; /* Ajusta este valor según tus necesidades */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Distribuye espacio entre los elementos */
            align-items: center;
            padding-top: 20px; /* Para un poco de espacio en la parte superior */
            z-index: 1000; /* Para asegurarte de que el navbar esté por encima de otros elementos */
        }

        .navbar-brand {
            margin-bottom: 20px;
        }

        .navbar-brand img {
            height: 100px;
        }

        .navbar-toggler {
            border: none;
            background-color: transparent;
        }

        .navbar-toggler:focus {
            outline: none;
        }

        .navbar-nav {
            width: 100%;
            display: flex;
            flex-direction: column; /* Asegura que los enlaces estén uno debajo del otro */
            align-items: center;
            margin-top: auto;
            margin-bottom: auto;
        }

        .navbar-nav .nav-link {
            color: white;
            margin: 10px 0;
            text-align: center;
            width: 100%;
        }

        @media (max-width: 991.98px) {
            .navbar-nav {
                display: flex;
                flex-direction: column;
                background-color: rgb(64, 165, 221);
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                width: 250px;
                padding: 10px;
                border-right: 1px solid rgba(255, 255, 255, 0.2);
            }

            .navbar-nav .nav-link {
                margin: 10px 0;
                padding: 5px 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }

            .navbar-brand {
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container flex-column">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="mainEncargado/agregarAreas.php">Agregar áreas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mainEncargado/controlEmpleados.php">Administrar usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mainEncargado/miCuenta.php">Mi cuenta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../modulos/logout.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="#"><img src="../imagenes/logoMuni.png" alt="logo"></a>
    </div>
</nav>
<div id="containerHead" style="margin-left: 170px;"> <!-- Ajusta el margen para evitar superposición -->
    <div id="inner-containerHead">
        <div class="itemHead">
            <a href="#"><img src="../imagenes/libro.png" class="imgBtnHead" alt="Novedades"></a>
            <p class="spanHead">NUESTRA HISTORIA</p>
        </div>
    </div>
</div>
<div id="container" style="margin-left: 170px;"> <!-- Ajusta el margen para evitar superposición -->
    <div id="inner-container">
        <div class="item" style="background-color: #006837;">
            <a href="#"><img src="../imagenes/profesora.png" class="imgBtn" alt="Novedades"></a>
            <p class="span">NOVEDADES</p>
        </div>
        <div class="item" style="background-color: #f1db3a;">
            <a href="#"><img src="../imagenes/familia.png" style="width: 200px; height: 180px;" class="imgBtn" alt="Actividades"></a>
            <p class="span">ACTIVIDADES</p>
        </div>
        <div class="item" style="background-color: #ef601e;"> 
            <a href="#"><img src="../imagenes/fotografia.png" class="imgBtn" alt="Galeria"></a>
            <p class="span">GALERIA</p>
        </div>
        <div class="item" style="background-color: #6432b7;">
            <a href="#"><img src="../imagenes/piezas.png" class="imgBtn" alt="Salitas"></a>
            <p class="span">SALITAS</p>
        </div>
        <div class="item" style="background-color: #e9765b;">
            <a href="#"><img src="../imagenes/chicos.png" class="imgBtn" alt="Proyecto"></a>
            <p class="span">PROYECTO</p>
        </div>
        <div class="item" style="background-color: #e51d1d;">
            <a href="#"><img src="../imagenes/calendario.png" class="imgBtn" alt="Calendario"></a>
            <p class="span">CALENDARIO</p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
