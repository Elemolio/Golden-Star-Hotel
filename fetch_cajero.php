<?php
include 'ConexiónBD.php';

if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];

    $sql = "SELECT * FROM cajero WHERE Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = array();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['success'] = true;
        $response['Nombre'] = $row['Nombre'];
        $response['Apellido'] = $row['Apellido'];
        $response['Correo'] = $row['Correo'];
    } else {
        $response['success'] = false;
        $response['error'] = "No se encontró el cajero";
    }
    echo json_encode($response);
    $stmt->close();
}

$conn->close();
?>
