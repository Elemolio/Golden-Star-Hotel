<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['ID_producto'];

    // Obtener todos los boletos relacionados con el producto
    $sql_get_boletos = "SELECT ID_boleto FROM Boleto WHERE Producto = ?";
    $stmt_get_boletos = $conn->prepare($sql_get_boletos);
    $stmt_get_boletos->bind_param('i', $id_producto);
    $stmt_get_boletos->execute();
    $result = $stmt_get_boletos->get_result();

    // Eliminar las referencias en la tabla huesped para cada boleto relacionado
    while ($row = $result->fetch_assoc()) {
        $id_boleto = $row['ID_boleto'];
        $sql_delete_huesped = "DELETE FROM Huesped WHERE ID_boleto = ?";
        $stmt_delete_huesped = $conn->prepare($sql_delete_huesped);
        $stmt_delete_huesped->bind_param('i', $id_boleto);
        $stmt_delete_huesped->execute();
        $stmt_delete_huesped->close();
    }

    $stmt_get_boletos->close();

    // Eliminar las referencias en la tabla boleto
    $sql_boleto = "DELETE FROM Boleto WHERE Producto = ?";
    $stmt_boleto = $conn->prepare($sql_boleto);
    $stmt_boleto->bind_param('i', $id_producto);
    $stmt_boleto->execute();
    $stmt_boleto->close();

    // Ahora eliminar el producto
    $sql = "DELETE FROM Producto WHERE ID_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_producto);
    if ($stmt->execute() === TRUE) {
        echo "Producto eliminado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
