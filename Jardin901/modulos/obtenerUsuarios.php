<?php
include('conexion.php');

// Consulta para obtener los usuarios
$query = "SELECT * FROM usuarios ORDER BY dni DESC";
$resultado = mysqli_query($conexion, $query);

$usuarios = array();

if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Verificar el estado
        $estado = ($fila['estado'] == 1) ? 'Verificado' : 'No verificado';

        // Verificar el cargo
        $cargo = ($fila['cargo'] == 1) ? 'Administrador' : 'Usuario';

        $datos = array(
            'dni' => $fila['dni'],
            'nombre' => $fila['nombre'],
            'apellido' => $fila['apellido'],
            'gmail' => $fila['gmail'],
            'cargo' => $cargo, // Mostrar 'Administrador' o 'Usuario'
            'estado' => $estado, // Mostrar 'Verificado' o 'No verificado'
        );
        $usuarios[] = $datos;
    }
}

echo json_encode($usuarios);

mysqli_close($conexion);
?>
