<?php
session_start();
include 'ConexiónBD.php';

if (!isset($_SESSION['cajero_id'])) {
    header("Location: login.php");
    exit();
}

$cajero_id = $_SESSION['cajero_id'];
$sql = "SELECT Usuario, Nombre, Apellido, Correo FROM Cajero WHERE Usuario = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $cajero_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No se encontraron detalles de la cuenta."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Error en la preparación de la consulta."]);
}
$conn->close();
?>