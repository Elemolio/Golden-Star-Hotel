<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_habitacion = $_POST['no_habitacion'];
    $paquete = $_POST['paquete'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];

    $sql = "INSERT INTO Producto (No_Habit, Paquete, Fecha_Inicio, Fecha_final) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $no_habitacion, $paquete, $fecha_inicio, $fecha_final);
    if ($stmt->execute()) {
        echo "<script>alert('Producto ingresado correctamente.'); window.location.href='gestion_producto.html';</script>";
    } else {
        echo "<script>alert('Error al ingresar el producto.'); window.location.href='ingresar_producto.html';</script>";
    }
    $stmt->close();
}

$conn->close();
?>
