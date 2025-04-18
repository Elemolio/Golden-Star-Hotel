<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el usuario existe
    $sql_verificar = "SELECT Usuario FROM cajero WHERE Usuario = ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bind_param("i", $id_usuario);
    $stmt_verificar->execute();
    $result_verificar = $stmt_verificar->get_result();

    if ($result_verificar->num_rows > 0) {
        // Actualizar el registro del cajero
        if (!empty($contrasena)) {
            $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);
            $sql = "UPDATE cajero SET Nombre=?, Apellido=?, Correo=?, Contrasena=? WHERE Usuario=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $nombre, $apellido, $correo, $contrasena_hash, $id_usuario);
        } else {
            $sql = "UPDATE cajero SET Nombre=?, Apellido=?, Correo=? WHERE Usuario=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $nombre, $apellido, $correo, $id_usuario);
        }

        if ($stmt->execute()) {
            echo "<script>alert('Cajero modificado exitosamente.'); window.location.href='gestion_cajero.html';</script>";
        } else {
            echo "<script>alert('Error al modificar el cajero: " . $stmt->error . "'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('El ID del usuario no existe.'); window.history.back();</script>";
    }

    $stmt_verificar->close();
}

$conn->close();
?>

