<?php
include 'ConexiónBD.php';

// Asegúrate de que hay un cajero en la base de datos
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
$correo = $_POST['correo'];

// Verifica si el cajero ya existe
$sql_check_cajero = "SELECT * FROM Cajero WHERE Correo='$correo'";
$result_cajero = $conn->query($sql_check_cajero);

if ($result_cajero->num_rows == 0) {
    $sql_insert_cajero = "INSERT INTO Cajero (Nombre, Apellido, Contrasena, Correo) VALUES ('$nombre', '$apellido', '$contrasena', '$correo')";
    if ($conn->query($sql_insert_cajero) === TRUE) {
        echo "Cajero creado exitosamente.";
        header("Location: indice_cajero.html");
    } else {
        echo "Error al crear el cajero: " . $sql_insert_cajero . "<br>" . $conn->error;
    }
} else {
    echo "El cajero ya existe.";
}

$conn->close();
?>
