<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $contrasena = password_hash($_POST['Contrasena'], PASSWORD_BCRYPT);
    $correo = $_POST['Correo'];

    $sql = "INSERT INTO Cajero (Nombre, Apellido, Contrasena, Correo) VALUES ('$nombre', '$apellido', '$contrasena', '$correo')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo huésped insertado exitosamente.";
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
    <title>Resultado de Inserción</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="gestion_cajero.html">Regresar</a>
</body>
</html>