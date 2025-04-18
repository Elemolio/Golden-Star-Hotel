<?php
session_start();
include 'ConexiónBD.php';

if (!isset($_SESSION['usuario'])) {
    echo "No se ha iniciado sesión.";
    exit();
}

$usuario = $_SESSION['usuario'];

// Fetch user details
$sql_usuario = "SELECT Nombre, Apellido, Correo FROM huesped WHERE Correo = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("s", $usuario);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();

if ($result_usuario->num_rows > 0) {
    $row_usuario = $result_usuario->fetch_assoc();
    $nombre = $row_usuario['Nombre'];
    $apellido = $row_usuario['Apellido'];
    $correo = $row_usuario['Correo'];
} else {
    echo "No se encontró un usuario con ese correo.";
    exit();
}

// Fetch boleto details
$sql_boleto = "SELECT h.Nombre, h.Apellido, h.Correo, b.Producto, b.Precio, b.ID_boleto 
               FROM vistaboletohuesped AS b
               JOIN huesped AS h ON b.Correo = h.Correo
               WHERE h.Correo = ?";
$stmt_boleto = $conn->prepare($sql_boleto);
$stmt_boleto->bind_param("s", $usuario);
$stmt_boleto->execute();
$result_boleto = $stmt_boleto->get_result();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Boleto</title>
    <link rel="stylesheet" href="tablestyle.css">
</head>
<body>
    <div class="container">
        <h2>Mi Boleto</h2>
        <?php
        if ($result_boleto->num_rows > 0) {
            echo "<table>";
            echo "<thead><tr><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Producto</th><th>Precio</th><th>ID Boleto</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result_boleto->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Nombre"] . "</td>";
                echo "<td>" . $row["Apellido"] . "</td>";
                echo "<td>" . $row["Correo"] . "</td>";
                echo "<td>" . $row["Producto"] . "</td>";
                echo "<td>" . $row["Precio"] . "</td>";
                echo "<td>" . $row["ID_boleto"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No se encontró un boleto para este usuario.";
        }
        ?>
        <a href="dashboard.php" class="button">Regresar</a>
    </div>
</body>
</html>

<?php
$stmt_usuario->close();
$stmt_boleto->close();
$conn->close();
?>
