<?php
    session_start();
    // Verificar si hay una sesión activa
    if (isset($_SESSION['dni'])) {
    $dniUsuario = $_SESSION['dni'];
    } else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header('Location: ../login.php');
    exit;
    }
    // Verificar si se recibió el parámetro DNI por método GET
    if (isset($_GET['dni'])) {
        // Obtener el DNI del usuario desde el parámetro GET
        $dni = $_GET['dni'];

        // Incluir el archivo de conexión a la base de datos
        include ('conexion.php');

        $sql = "SELECT * FROM usuarios WHERE dni = '$dni'";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            // Asignar los resultados a $row
            $row = mysqli_fetch_assoc($result);
        }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Document</title>
        <style>
            body {
                padding-top: 0;
                background-color: #f4f4f4 !important;
                position: relative;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                color: white;
                padding-bottom: 100px;
            }

            .container-body{
                background-color: white !important;
                width: 700px;
                padding: 30px;
                border-radius: 10px;
                font-size: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            #logo-container {
                margin-top: 80px;
                margin-bottom: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            label{
                color: #333;
            }
            footer {
                width: 100%;
                background-color: rgb(64, 165, 221);
                text-align: center;
                padding: 10px 0;
                position: fixed;
                bottom: 0;
            }
        </style>
    </head>
    <body>
        <!-- <div id="logo-container">
            <img src="../../imagenes/logoMuniAzul.png" alt="logo" style="height: 100px;">
        </div> -->
        <br>
        <div class="container-body"> 
            <a class="btn btn-danger" href="../modulos/gestionarUsuarios.php" role="button" style="text-decoration: none; color:white; font-size:17px; margin-bottom:10px;">
                <img src="../imagenes/arrow_return_icon_175872.png" style="width: 20px; height: auto;"> Volver
            </a>
            <br>
            <!-- <form method="POST" id="formulario-modificar"> -->
                <div class="mb-3 mt-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" name="dni" id="dni" class="form-control" value="<?php echo $row["dni"]; ?>">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $row['nombre']; ?>">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $row['apellido']; ?>">
                </div>
                <div class="mb-3">
                    <label for="gmail" class="form-label">Gmail:</label>
                    <input type="text" name="gmail" id="gmail" class="form-control" value="<?php echo $row['gmail']; ?>">
                </div>
                <div class="mb-3">
                    <label for="cargo" class="form-label">Cargo:</label>
                    <select name="cargo" id="cargo" class="form-select">
                        <?php
                                $cargoActualMostrado = false;

                                if ($row['cargo'] === '1') {
                                    echo "<option value='1' selected>Directivo</option>";
                                    $cargoActualMostrado = true;
                                } else if ($row['cargo'] === '2') {
                                    echo "<option value='2' selected>Maestra</option>";
                                    $cargoActualMostrado = true;
                                }
                                include("traerCargos.php");
                                // Verificar si hay resultados para los cargos
                                if ($resultadoCargos->num_rows > 0) {
                                    while ($cargo =  mysqli_fetch_assoc($resultadoCargos)) {
                                        // Verificar si el cargo coincide con el valor obtenido de la consulta
                                        $selected = ($row['cargo'] == $cargo['nombreCargo']) ? "selected" : "";
                                        echo "<option value='" . $cargo['idCargo'] . "' $selected>" . $cargo['nombreCargo'] . "</option>";
                                    }
                                } else {
                                    echo "<option disabled>No hay más cargos disponibles</option>";
                                }
                                
                                ?>
                                </select>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" id="modificar" class="btn btn-warning">Guardar Modificación</button>
                </div>
            <!-- </form> -->
        </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="../funciones/guardarModificaciones.js"></script>
</body>
</html>