<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plan_entretenimiento = $_POST['Plan_entretenimiento'];
    $plan_comida = $_POST['Plan_comida'];

    // Verificar si los campos no están vacíos
    if (!empty($plan_entretenimiento) && !empty($plan_comida)) {
        // Insertar el nuevo paquete en la tabla 'paquete'
        $sql_insertar = "INSERT INTO paquete (Plan_entretenimiento, Plan_comida) VALUES (?, ?)";
        $stmt_insertar = $conn->prepare($sql_insertar);
        $stmt_insertar->bind_param("ii", $plan_entretenimiento, $plan_comida);

        if ($stmt_insertar->execute()) {
            echo "<script>alert('Paquete ingresado exitosamente.'); window.location.href = 'gestion_paquete.html';</script>";
        } else {
            echo "<script>alert('Error al ingresar el paquete: " . $stmt_insertar->error . "'); window.history.back();</script>";
        }
        $stmt_insertar->close();
    } else {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Solicitud no válida.'); window.history.back();</script>";
}

$conn->close();
?>
