<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_habitacion = $_POST['no_habitacion'];
    $capacidad = $_POST['capacidad'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO habitacion (No_Habitacion, Capacidad, Estado) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $no_habitacion, $capacidad, $estado);

    if ($stmt->execute()) {
        echo "<script>alert('Habitación insertada exitosamente.'); window.location.href = 'gestion_habitacion.html';</script>";
    } else {
        echo "<script>alert('Error al insertar la habitación: " . $stmt->error . "'); window.history.back();</script>";
    }
    $stmt->close();
}

$conn->close();
?>
