<?php
include 'ConexiónBD.php';

if (isset($_POST['No_Habitacion'])) {
    $no_habitacion = $_POST['No_Habitacion'];

    $sql = "SELECT * FROM habitacion WHERE No_Habitacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $no_habitacion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $habitacion = $result->fetch_assoc();
        echo json_encode($habitacion);
    } else {
        echo json_encode(['error' => 'No se encontró la habitación.']);
    }

    $stmt->close();
    $conn->close();
}
?>
