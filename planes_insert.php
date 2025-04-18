<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Insertar el nuevo plan de entretenimiento
    $sql = "INSERT INTO Plan_entretenimiento (nombre, descripcion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nombre, $descripcion);
    if ($stmt->execute() === TRUE) {
        echo "Plan de entretenimiento insertado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Modificación</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="gestion_planes.html">Regresar</a>
</body>
</html>
