<?php
include 'ConexiónBD.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Huesped WHERE ID_huesped = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>Nombre: " . $row['Nombre'] . "</p>";
        echo "<p>Apellido: " . $row['Apellido'] . "</p>";
        echo "<p>Correo: " . $row['Correo'] . "</p>";
    } else {
        echo "";
    }

    $stmt->close();
}
$conn->close();
?>
