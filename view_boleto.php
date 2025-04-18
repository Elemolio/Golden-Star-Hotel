<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Incluir archivo de conexión
include 'ConexiónBD.php';

// Obtener el correo del usuario actual
$correo_usuario_actual = $_SESSION['usuario'];

// Obtener la información del boleto para el usuario actual
$sql = "SELECT * FROM vistaboletohuesped WHERE Correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo_usuario_actual);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $boleto = $result->fetch_assoc();
} else {
    $boleto = null;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Boleto - Golden Star Hotel</title>
    <link rel="stylesheet" href="tablestyle.css">
</head>
<body>
    <div class="container">
        <h2>Mi Boleto</h2>
        <?php if ($boleto): ?>
            <table>
                <tr>
                    <th>ID Boleto</th>
                    <td><?php echo $boleto['ID_boleto']; ?></td>
                </tr>
                <tr>
                    <th>Producto</th>
                    <td><?php echo $boleto['Producto']; ?></td>
                </tr>
                <tr>
                    <th>Precio</th>
                    <td><?php echo $boleto['Precio']; ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>No se encontró un boleto para este usuario.</p>
        <?php endif; ?>
        <a href="dashboard.php" class="button">Regresar</a>
    </div>
</body>
</html>

