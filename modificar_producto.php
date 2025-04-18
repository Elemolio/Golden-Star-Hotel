<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $no_habitacion = $_POST['no_habitacion'];
    $paquete = $_POST['paquete'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];

    $sql = "UPDATE Producto SET No_Habit = ?, Paquete = ?, Fecha_Inicio = ?, Fecha_final = ? WHERE ID_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $no_habitacion, $paquete, $fecha_inicio, $fecha_final, $id_producto);
    if ($stmt->execute()) {
        echo "<script>alert('Producto actualizado correctamente.'); window.location.href='gestion_producto.html';</script>";
    } else {
        echo "<script>alert('Error al actualizar el producto.'); window.location.href='modificar_producto.html';</script>";
    }
    $stmt->close();
}

$conn->close();
?>
