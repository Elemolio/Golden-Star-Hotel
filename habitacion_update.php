<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_habitacion = $_POST['No_Habitacion'];
    $capacidad = $_POST['Capacidad'];
    $estado = $_POST['Estado'];

    $sql = "UPDATE Habitacion SET Capacidad = ?, Estado = ? WHERE No_Habitacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $capacidad, $estado, $no_habitacion);
    if ($stmt->execute() === TRUE) {
        echo "Habitación actualizada exitosamente.";
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
    <title>Resultado de Eliminación</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="gestion_habitacion.html">Regresar</a>
</body>
</html>