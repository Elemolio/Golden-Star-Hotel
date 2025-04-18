<?php
include 'ConexiónBD.php';

if (isset($_GET['id_huesped'])) {
    $id_huesped = $_GET['id_huesped'];
    $sql = "SELECT Nombre, Apellido, Correo, ID_boleto FROM Huesped WHERE ID_huesped=$id_huesped";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(null);
    }

    $conn->close();
}
?>
