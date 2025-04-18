<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_boleto = $_POST['id_boleto'];

    // Eliminar el boleto
    $sql = "DELETE FROM Boleto WHERE ID_boleto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_boleto);
    if ($stmt->execute()) {
        echo "<script>alert('Boleto eliminado correctamente.'); window.location.href='gestion_boleto.html';</script>";
    } else {
        echo "<script>alert('Error al eliminar el boleto.'); window.location.href='eliminar_boleto.php';</script>";
    }
    $stmt->close();
}

$conn->close();
?>