<?php
    session_start();
    $usuarioLogueado = false;
    if (isset($_SESSION['dni'])) {
        $dniUsuario = $_SESSION['dni'];
        $cargoUsuario = $_SESSION['Cargo'];
        $usuarioLogueado = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/gestionarUsuarios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <title>Control de usuarios</title>
</head>
<body>
<div class="row mx-0 p-0">
    <div class="col-12 col-md-6">
        <div class="container-body">
            <div class="form-group form-container">
                <a class="btn btn-danger mb-2" href="../index.php" role="button" style="color: white; width:100px; height: auto;">
                    <img src="../imagenes/arrow_return_icon_175872.png" style="width: 20px; height: auto;"> Volver
                </a>
                <br><br>
                <h2 class="titulo mb-4">Cargar usuarios</h2>
                <input type="text" id="dni" placeholder="DNI del usuario..." class="form-control">
                <input type="text" id="nombre" placeholder="Nombre del usuario..." class="form-control">
                <input type="text" id="apellido" placeholder="Apellido del usuario..." class="form-control">
                <input type="email" id="email" placeholder="Email del usuario..." class="form-control">
                <select id="cargo" class="form-select">
                    <option selected disabled>Seleccione un cargo</option>
                    <?php include('../modulos/traerCargos.php'); ?>
                </select>
                <center><button class="btn btn-success" id="cargar">Cargar</button></center>
            </div>
        </div>    
    </div>
    <div class="col-12 col-md-3">
        <div class="container-body3">
            <div class="form-group form-container">
                <h2>Enviar mail de verificacion</h2>
                <input type="text" id="dniVerificar" placeholder="Ingrese el Dni del Usuario...">
                <input type="text" id="mailVerificar" placeholder="Ingrese el mail del usuario...">
                <center><input type="button" id="enviar" class="btn btn-success" value="Enviar"></center>
            </div>

        </div>
    </div>
</div>

<div class="container-body2 scrollable">
    <div id="tabla" class="form-group"></div>
</div>

<footer class="text-white text-center p-3" style="background-color: rgb(64, 165, 221);">
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> Municipalidad de La Costa – Av.Costanera 8001 – Mar del Tuyú Buenos Aires, CP(B7108GPE) – Tel: +54 (02246) 433-000</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="../funciones/gestionarUsuarios.js"></script>
</body>
</html>
