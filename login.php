<?php
session_start();
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contrasena'];

    $sql = "SELECT * FROM huesped WHERE Correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['Contrasena'])) {
            $_SESSION['usuario'] = $row['Nombre'];
            header("Location: dashboard.php"); // Redirigir al Dashboard
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Correo no registrado";
    }
}
?>

