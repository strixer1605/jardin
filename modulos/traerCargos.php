<?php
    include('conexion.php');

    $sql = "SELECT * FROM `cargos` ORDER by idCargo DESC";
    $resultadoCargos = $conexion->query($sql);

    if ($resultadoCargos) {
        while ($fila = $resultadoCargos->fetch_assoc()) {
            echo "<option value='".$fila['idCargo']."'>".$fila['nombreCargo']."</option>";
        }
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
?>