<?php
include 'ConexiónBD.php';

if (isset($_GET['id_huesped'])) {
    $id_huesped = $_GET['id_huesped'];

    $sql = "SELECT Nombre, Apellido, Correo, Contrasena, ID_boleto FROM Huesped WHERE ID_huesped = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_huesped);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(null);
    }

    $stmt->close();
}

$conn->close();
?>
