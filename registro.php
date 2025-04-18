<?php
session_start();
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    $correo = $conn->real_escape_string($_POST['correo']);
    $tipo = 'usuario'; // Tipo de cuenta por defecto

    try {
        // Llamar al procedimiento almacenado CrearHuesped
        $stmt = $conn->prepare("CALL CrearHuesped(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellido, $contrasena, $correo, $tipo);

        if ($stmt->execute()) {
            // Obtener el ID del huésped recién creado
            $result = $conn->query("SELECT ID_huesped FROM Huesped WHERE Correo = '$correo'");
            $row = $result->fetch_assoc();
            $id_huesped = $row['ID_huesped'];
            
            // Asegurarse de que exista un producto válido
            $result_producto = $conn->query("SELECT ID_producto FROM Producto LIMIT 1");
            if ($result_producto->num_rows == 0) {
                // Insertar un producto dummy si no existe ninguno
                $conn->query("INSERT INTO Producto (No_Habit, Paquete, Fecha_Inicio, Fecha_final) VALUES (1, 1, CURDATE(), CURDATE() + INTERVAL 1 YEAR)");
                $product_id = $conn->insert_id;
            } else {
                $product_id = $result_producto->fetch_assoc()['ID_producto'];
            }

            // Insertar el boleto
            $sql_boleto = "INSERT INTO Boleto (Cajero, Cliente, Producto, Precio, Caducidad) VALUES (1, $id_huesped, $product_id, 100, '2024-12-31')";
            if ($conn->query($sql_boleto) === TRUE) {
                $id_boleto = $conn->insert_id; // Obtener el ID del boleto recién creado

                // Asignar el boleto al huésped usando el procedimiento almacenado
                $stmt_asignar = $conn->prepare("CALL AsignarBoletoAHuesped(?, ?)");
                $stmt_asignar->bind_param("ii", $id_huesped, $id_boleto);

                if ($stmt_asignar->execute()) {
                    // Inicio de sesión exitoso, guardar datos en la sesión
                    $_SESSION['usuario'] = $nombre; // Guardar el nombre del usuario en la sesión
                    $_SESSION['id_huesped'] = $id_huesped; // Guardar el ID del huésped en la sesión
                    
                    // Redirigir al usuario al dashboard
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Error al asignar el boleto: " . $stmt_asignar->error;
                }

                $stmt_asignar->close();
            } else {
                echo "Error al crear el boleto: " . $conn->error;
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == '45000') {
            echo "Este correo ya está registrado.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}

$conn->close();
?>
