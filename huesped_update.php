<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_huesped = $_POST['ID_huesped'];
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $contrasena = password_hash($_POST['Contrasena'], PASSWORD_BCRYPT);
    $correo = $_POST['Correo'];
    $id_boleto = $_POST['ID_boleto'];

    // Verificar si el boleto existe
    $sql_verificar_boleto = "SELECT ID_boleto FROM boleto WHERE ID_boleto = ?";
    $stmt_verificar_boleto = $conn->prepare($sql_verificar_boleto);
    $stmt_verificar_boleto->bind_param("i", $id_boleto);
    $stmt_verificar_boleto->execute();
    $result_verificar_boleto = $stmt_verificar_boleto->get_result();

    if ($result_verificar_boleto->num_rows > 0) {
        // Actualizar el registro del huésped
        $sql = "UPDATE Huesped SET Nombre=?, Apellido=?, Contrasena=?, Correo=?, ID_boleto=? WHERE ID_huesped=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $nombre, $apellido, $contrasena, $correo, $id_boleto, $id_huesped);

        if ($stmt->execute()) {
            echo "Huésped modificado exitosamente.";
        } else {
            echo "Error al modificar el huésped: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "El ID del boleto no existe.";
    }

    $stmt_verificar_boleto->close();
}

$conn->close();
?>