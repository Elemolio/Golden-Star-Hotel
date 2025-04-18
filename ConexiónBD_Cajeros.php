<?php
$servername = "localhost";
$username = "admin";
$password = "goldenstarhotel123admin";
$dbname = "goldenstarhotel";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
$conn->close();
?>