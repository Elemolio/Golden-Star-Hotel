<?php
include 'ConexiónBD.php';

if (isset($_GET['id_boleto'])) {
    $id_boleto = $_GET['id_boleto'];

    $sql = "SELECT * FROM Boleto WHERE ID_boleto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_boleto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<table>
                <tr><th>ID Boleto</th><td>{$row['ID_boleto']}</td></tr>
                <tr><th>Cajero</th><td>{$row['Cajero']}</td></tr>
                <tr><th>Cliente</th><td>{$row['Cliente']}</td></tr>
                <tr><th>Producto</th><td>{$row['Producto']}</td></tr>
                <tr><th>Precio</th><td>{$row['Precio']}</td></tr>
                <tr><th>Caducidad</th><td>{$row['Caducidad']}</td></tr>
              </table>";
    } else {
        echo "<p>No se encontró el boleto con ID $id_boleto.</p>";
    }
    $stmt->close();
}

$conn->close();
?>
