<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cajero = $_POST['cajero'];
    $cliente = $_POST['cliente'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $caducidad = $_POST['caducidad'];

    $sql = "INSERT INTO Boleto (Cajero, Cliente, Producto, Precio, Caducidad) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiids", $cajero, $cliente, $producto, $precio, $caducidad);
    if ($stmt->execute()) {
        echo "<script>alert('Boleto ingresado correctamente.'); window.location.href='gestion_boleto.html';</script>";
    } else {
        echo "<script>alert('Error al ingresar el boleto.'); window.location.href='ingresar_boleto.html';</script>";
    }
    $stmt->close();
}

$conn->close();
?>