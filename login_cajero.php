<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM Cajero WHERE Correo='$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['Contrasena'])) {
            echo "Inicio de sesión exitoso. Bienvenido, " . $row['Nombre'] . " " . $row['Apellido'] . "!";
            header("Location: indice_cajero.html");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No existe una cuenta asociada a este correo.";
    }
}

$conn->close();
?>