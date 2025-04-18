<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paquete = $_POST['ID_paquete'];

    // Preparar y ejecutar la consulta de eliminación
    $sql = "DELETE FROM Paquete WHERE ID_paquete = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_paquete);

    if ($stmt->execute()) {
        echo "Paquete eliminado exitosamente.";
    } else {
        echo "Error al eliminar el paquete: " . $stmt->error;
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
    <title>Resultado de Eliminación</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="gestion_paquetes.html">Regresar</a>
</body>
</html>