<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_boleto = $_POST['id_boleto'];
    $cajero = $_POST['cajero'];
    $cliente = $_POST['cliente'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $caducidad = $_POST['caducidad'];

    $sql = "UPDATE Boleto SET Cajero = ?, Cliente = ?, Producto = ?, Precio = ?, Caducidad = ? WHERE ID_boleto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiidsi", $cajero, $cliente, $producto, $precio, $caducidad, $id_boleto);
    if ($stmt->execute()) {
        echo "<script>alert('Boleto actualizado correctamente.'); window.location.href='gestion_boleto.html';</script>";
    } else {
        echo "<script>alert('Error al actualizar el boleto.'); window.location.href='modificar_boleto.html';</script>";
    }
    $stmt->close();
}

$conn->close();
?>