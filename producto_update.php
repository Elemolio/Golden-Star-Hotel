<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $no_habitacion = $_POST['no_habitacion'];
    $id_paquete = $_POST['id_paquete'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];

    // Obtener la habitación actual del producto
    $sql_get_habitacion_actual = "SELECT No_Habit FROM producto WHERE ID_producto = ?";
    $stmt_get_habitacion_actual = $conn->prepare($sql_get_habitacion_actual);
    $stmt_get_habitacion_actual->bind_param("i", $id_producto);
    $stmt_get_habitacion_actual->execute();
    $result_get_habitacion_actual = $stmt_get_habitacion_actual->get_result();
    $row_actual = $result_get_habitacion_actual->fetch_assoc();
    $habitacion_actual = $row_actual['No_Habit'];

    // Actualizar el producto
    $sql = "UPDATE producto SET No_Habit = ?, Paquete = ?, Fecha_Inicio = ?, Fecha_Final = ? WHERE ID_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $no_habitacion, $id_paquete, $fecha_inicio, $fecha_final, $id_producto);

    if ($stmt->execute()) {
        // Cambiar el estado de la habitación actual a disponible si se cambió de habitación
        if ($habitacion_actual != $no_habitacion) {
            $sql_update_habitacion_actual = "UPDATE habitacion SET Estado = 0 WHERE No_Habitacion = ?";
            $stmt_update_habitacion_actual = $conn->prepare($sql_update_habitacion_actual);
            $stmt_update_habitacion_actual->bind_param("i", $habitacion_actual);
            $stmt_update_habitacion_actual->execute();
        }
        // Cambiar el estado de la nueva habitación a ocupada
        $sql_update_nueva_habitacion = "UPDATE habitacion SET Estado = 1 WHERE No_Habitacion = ?";
        $stmt_update_nueva_habitacion = $conn->prepare($sql_update_nueva_habitacion);
        $stmt_update_nueva_habitacion->bind_param("i", $no_habitacion);
        $stmt_update_nueva_habitacion->execute();

        echo "<script>alert('Producto modificado exitosamente.'); window.location.href = 'gestion_producto.html';</script>";
    } else {
        echo "<script>alert('Error al modificar el producto: " . $stmt->error . "'); window.history.back();</script>";
    }
    $stmt->close();
}

$conn->close();
?>

