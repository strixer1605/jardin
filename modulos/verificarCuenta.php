<?php
include('conexion.php');

// Establecer la zona horaria a Buenos Aires, Argentina
date_default_timezone_set('America/Argentina/Buenos_Aires');

// Verificar si se proporcionó un token en la URL
if (isset($_GET['token'])) {
    // Obtener el token de la URL
    $token = $_GET['token'];

    // Consultar la tabla tokens para encontrar el dni asociado al token
    $consultaToken = "SELECT dni, fecha_creacion FROM tokens WHERE token = ?";
    $stmtToken = mysqli_prepare($conexion, $consultaToken);
    mysqli_stmt_bind_param($stmtToken, "s", $token);
    mysqli_stmt_execute($stmtToken);
    $resultadoToken = mysqli_stmt_get_result($stmtToken);

    if ($resultadoToken->num_rows > 0) {
        // Si se encontró un resultado, obtener el dni y la fecha de creación del token
        $filaToken = $resultadoToken->fetch_assoc();
        $dni = $filaToken['dni'];
        $fechaCreacion = $filaToken['fecha_creacion'];

        // Verificar si el token ha expirado (1 hora de validez)
        $fechaActual = date('Y-m-d H:i:s');
        $diferencia = strtotime($fechaActual) - strtotime($fechaCreacion);

        if ($diferencia > 3600) { // 3600 segundos = 1 hora
            echo "El token ha expirado.";
            exit;
        }
    } else {
        // Si no se encontró ningún resultado, mostrar un mensaje de error o redirigir a una página de error
        echo "Token no válido.";
        exit; // Terminar el script para evitar ejecución adicional
    }
} else {
    // Si no se proporcionó un token en la URL, mostrar un mensaje de error o redirigir a una página de error
    echo "No se proporcionó un token.";
    exit; // Terminar el script para evitar ejecución adicional
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mainCss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Recuperar Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #logo-container {
            margin-bottom: 20px;
        }

        .form-signin {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Max width for the container */
            width: 100%; /* Full width for responsiveness */
        }

        .form-signin h2 {
            margin-bottom: 20px;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-floating input {
            height: 50px;
            padding: 10px;
            font-size: 16px;
        }

        .form-floating label {
            padding: 10px;
        }

        button[type="submit"] {
            background-color: #007bff;
            border: none;
            padding: 10px;
            font-size: 18px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        footer {
            width: 100%;
            padding: 10px;
            background-color: rgb(64, 165, 221);
            color: white;
            text-align: center;
            position: fixed;
            bottom: 0;
        }

    </style>
</head>
<body class="text-center">
    <div id="logo-container" class="text-center">
        <img src="../imagenes/logoMuniAzul.png" alt="logo" style="height: 100px; width: 145px;">
    </div>
    <main class="form-signin w-100 m-auto">
        <form action="consultaVerificar.php" method="POST">
            <h2 class="h3 mb-3 fw-normal">Ingrese su nueva contraseña</h2>
            <div class="form-floating my-3">
                <input type="password" class="form-control" id="floatingInput" name="nuevaContraseña" required>
                <input type="hidden" name="dni" value="<?php echo $dni; ?>">
                <label for="floatingInput">Nueva contraseña</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Nueva contraseña</button>
        </form>
    </main>
    <footer class="text-white text-center p-3" style="height: auto; background-color: rgb(64, 165, 221);" id="footer">
        <div class="container">
            <p>&copy; <?php echo date("Y / "); ?>Municipalidad de La Costa – Av.Costanera 8001 – Mar del Tuyú Buenos Aires, CP(B7108GPE) – Tel: +54 (02246) 433-000</p>
        </div>
    </footer>
</body>
</html>
