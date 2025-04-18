<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_plan = $_POST['id_plan'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE plan_entretenimiento SET Nombre = ?, Descripcion = ? WHERE ID_entretenimiento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $descripcion, $id_plan);

    if ($stmt->execute()) {
        echo "<script>alert('Plan de entretenimiento modificado exitosamente.'); window.location.href = 'gestion_planes.html';</script>";
    } else {
        echo "<script>alert('Error al modificar el plan de entretenimiento: " . $stmt->error . "'); window.history.back();</script>";
    }
    $stmt->close();
}

$conn->close();
?>

