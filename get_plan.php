<?php
include 'ConexiónBD.php';

if (isset($_GET['id_entretenimiento'])) {
    $id_entretenimiento = $_GET['id_entretenimiento'];

    $sql = "SELECT Nombre, Descripcion FROM plan_entretenimiento WHERE ID_entretenimiento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_entretenimiento);
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

