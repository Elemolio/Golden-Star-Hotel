<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_habit = $_POST['No_Habit'];
    $paquete = $_POST['Paquete'];
    $fecha_inicio = $_POST['Fecha_Inicio'];
    $fecha_final = $_POST['Fecha_final'];

    // Verificar si el paquete existe
    $sql_check_paquete = "SELECT ID_paquete FROM Paquete WHERE ID_paquete = ?";
    $stmt_check_paquete = $conn->prepare($sql_check_paquete);
    $stmt_check_paquete->bind_param('i', $paquete);
    $stmt_check_paquete->execute();
    $result_check_paquete = $stmt_check_paquete->get_result();

    if ($result_check_paquete->num_rows > 0) {
        // Si el paquete existe, insertar el producto
        $sql = "INSERT INTO Producto (No_Habit, Paquete, Fecha_Inicio, Fecha_final) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiss', $no_habit, $paquete, $fecha_inicio, $fecha_final);
        if ($stmt->execute() === TRUE) {
            echo "Producto insertado exitosamente.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: El paquete especificado no existe.";
    }

    $stmt_check_paquete->close();
    $conn->close();
}
?>
