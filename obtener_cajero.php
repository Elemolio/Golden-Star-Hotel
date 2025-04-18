<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];

    $sql = "SELECT * FROM Cajero WHERE Usuario=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
}

$conn->close();
?>
