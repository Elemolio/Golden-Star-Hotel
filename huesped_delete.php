<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_huesped = $_POST['ID_huesped'];

    $sql = "DELETE FROM Huesped WHERE ID_huesped=$id_huesped";

    if ($conn->query($sql) === TRUE) {
        echo "Huésped eliminado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

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
    <a href="gestion_huesped.html">Regresar</a>
</body>
</html>