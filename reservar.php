<?php
include 'ConexiónBD.php';

$message = "";
$link = "reservar.html";

if (isset($_POST['no_habitacion']) && isset($_POST['id_paquete']) && isset($_POST['fecha_inicio']) && isset($_POST['fecha_final'])) {
    $no_habitacion = $_POST['no_habitacion'];
    $id_paquete = $_POST['id_paquete'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];

    // Verificar si la habitación está disponible
    $sql_verificar = "SELECT Estado FROM habitacion WHERE No_Habitacion = ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bind_param("i", $no_habitacion);
    $stmt_verificar->execute();
    $result_verificar = $stmt_verificar->get_result();

    if ($result_verificar->num_rows > 0) {
        $row = $result_verificar->fetch_assoc();
        if ($row['Estado'] == 0) {
            // Insertar la nueva reserva en la tabla 'producto'
            $sql_insertar = "INSERT INTO producto (No_Habit, Paquete, Fecha_Inicio, Fecha_Final) VALUES (?, ?, ?, ?)";
            $stmt_insertar = $conn->prepare($sql_insertar);
            $stmt_insertar->bind_param("iiss", $no_habitacion, $id_paquete, $fecha_inicio, $fecha_final);

            if ($stmt_insertar->execute()) {
                // Actualizar el estado de la habitación a ocupada
                $sql_actualizar = "UPDATE habitacion SET Estado = 1 WHERE No_Habitacion = ?";
                $stmt_actualizar = $conn->prepare($sql_actualizar);
                $stmt_actualizar->bind_param("i", $no_habitacion);
                $stmt_actualizar->execute();

                $message = "Reserva realizada con éxito.";
            } else {
                $message = "Error al realizar la reserva: " . $stmt_insertar->error;
            }
        } else {
            $message = "La habitación no está disponible.";
        }
    } else {
        $message = "No se encontró la habitación.";
    }
} else {
    $message = "Faltan datos en el formulario.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Paquete</title>
    <link rel="stylesheet" href="formstyle.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php echo $message; ?></p>
            <a href="<?php echo $link; ?>" class="button">Regresar</a>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        window.onload = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
            window.location.href = "<?php echo $link; ?>";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                window.location.href = "<?php echo $link; ?>";
            }
        }
    </script>
</body>
</html>


