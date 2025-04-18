<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_habitacion = $_POST['No_Habitacion'];

    $sql = "DELETE FROM Habitacion WHERE No_Habitacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $no_habitacion);
    if ($stmt->execute() === TRUE) {
        echo "Habitación eliminada exitosamente.";
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
