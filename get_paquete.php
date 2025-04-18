<?php
include 'ConexiónBD.php';

if (isset($_GET['id_paquete'])) {
    $id_paquete = $_GET['id_paquete'];
    $sql = "SELECT * FROM Paquete WHERE ID_paquete = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_paquete);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(null);
    }

    $stmt->close();
}
$conn->close();
?>
