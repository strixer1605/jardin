<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datosJSON = file_get_contents('php://input');
    $datos = json_decode($datosJSON, true);

    if (isset($datos["dni"]) && isset($datos["contraseña"])) {
        $dni = $datos["dni"];
        $contraseña = $datos["contraseña"];
        
        // Consulta para obtener los datos del usuario
        $consulta_usuario = "SELECT * FROM `usuarios` WHERE dni = '$dni'";
        $resultado_usuario = $conexion->query($consulta_usuario);

        if ($resultado_usuario->num_rows > 0) {
            $fila = $resultado_usuario->fetch_assoc();
            $dniUser = $fila['dni'];
            $nombreUser = $fila['nombre'];
            $apellidoUser = $fila['apellido'];
            $correoUser = $fila['gmail'];
            $hashedPassword = $fila['contraseña'];
            $cargoId = $fila['cargo'];
            $estado = $fila['estado'];
            // $areaId = $fila['area'];
            // $conexionUser = $fila['ultimaConexion'];
            // $ultimaCon = date('d-m-Y H:i:s', strtotime($conexionUser));

            // Verificar si la contraseña es correcta
            if (password_verify($contraseña, $hashedPassword)) {
                // Consulta para obtener el nombre del cargo
                $consulta_cargo = "SELECT nombreCargo FROM `cargos` WHERE idCargo = $cargoId";
                $resultado_cargo = $conexion->query($consulta_cargo);
                $fila_cargo = $resultado_cargo->fetch_assoc();
                $cargoUser = $fila_cargo['nombreCargo'];

                // Consulta para obtener el nombre del área y verificar su estado
                // $consulta_area = "SELECT nombre, estado FROM `areas` WHERE idArea = $areaId";
                // $resultado_area = $conexion->query($consulta_area);
                // $fila_area = $resultado_area->fetch_assoc();
                // $areaUser = $fila_area['nombre'];
                // $estadoArea = $fila_area['estado'];

                if ($estado == 1) {
                    // Iniciar sesión y asignar variables de sesión
                    session_start();
                    $_SESSION['Usuario'] = $nombreUser;
                    $_SESSION['Apellido'] = $apellidoUser;
                    $_SESSION['dni'] = $dniUser;
                    $_SESSION['Correo'] = $correoUser;
                    // $_SESSION['ultimaCon'] = $ultimaCon;
                    $_SESSION['estado'] = $estado;

                    // Asignar el nombre del cargo y del área a las variables de sesión
                    $_SESSION['Cargo'] = $cargoUser;
                    // $_SESSION['Area'] = $areaUser;

                    // Redireccionar según el cargo
                    if ($cargoId == 1) {
                        $_SESSION['Cargo'] = "Directivo";
                        http_response_code(200);
                        echo json_encode(array('success' => true, 'message' => 'Bienvenido', 'redirect' => '../admin/admin.php'));
                        exit;
                    } elseif ($cargoId == 2) {
                        $_SESSION['Cargo'] = "Maestra";
                        http_response_code(200);
                        echo json_encode(array('success' => true, 'message' => 'Bienvenido', 'redirect' => '../admin/admin.php'));
                        exit;
                    } elseif ($cargoId == 3) {
                        $_SESSION['Cargo'] = "Maestra";
                        http_response_code(200);
                        echo json_encode(array('success' => true, 'message' => 'Bienvenido', 'redirect' => '../admin/admin.php'));
                        exit;
                    } 
                    else {
                        http_response_code(400); // Código de estado de error de solicitud
                        echo json_encode(array('success' => false, 'message' => 'Cargo desconocido'));
                        exit;
                    }
                } else {
                    http_response_code(400); // Código de estado de error de solicitud
                    echo json_encode(array('success' => false, 'message' => 'Usuario o área desactivados'));
                    exit;
                }
            }
             else {
                http_response_code(400); // Código de estado de error de solicitud
                echo json_encode(array('success' => false, 'message' => 'Contraseña incorrecta'));
                exit;
            }
        } else {
            http_response_code(400); // Código de estado de error de solicitud
            echo json_encode(array('success' => false, 'message' => 'Usuario no encontrado'));
            exit;
        }
    } else {
        http_response_code(400); // Código de estado de error de solicitud
        echo json_encode(array('success' => false, 'message' => 'Datos no recibidos correctamente'));
        exit;
    }
} else {
    exit();
}
?>