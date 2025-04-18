<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];

    $sql = "DELETE FROM cajero WHERE Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario);
    if ($stmt->execute()) {
        echo "<script>alert('Cajero eliminado correctamente.'); window.location.href='gestion_cajero.html';</script>";
    } else {
        echo "<script>alert('Error al eliminar el cajero.'); window.location.href='eliminar_cajero.html';</script>";
    }
    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Inserción</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="gestion_cajero.html">Regresar</a>
</body>
</html>