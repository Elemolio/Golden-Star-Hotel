<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'ConexiónBD.php';

$sql = "SELECT * FROM vistapaquetes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Golden Star Hotel</title>
    <link rel="stylesheet" href="dashboardstyle.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Golden Star Hotel</h1>
            <nav>
                <a href="reservar.html">Reservar</a>
                <a href="logout.php">Cerrar sesión</a>
            </nav>
        </header>
        <main>
            <h2>Paquetes Disponibles</h2>
            <table>
                <thead>
                    <tr>
                        <th>Paquete</th>
                        <th>Plan de Entretenimiento</th>
                        <th>Plan de Comida</th>
                    </tr>
                </thead>
                <tbody>
                <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><a href='detalles_paquete.php?id_paquete=" . $row["ID_paquete"] . "'>" . $row["ID_paquete"] . "</a></td>";
                    echo "<td>" . $row["nombre_entretenimiento"] . "</td>";
                    echo "<td>" . ($row["Plan_comida"] == 1 ? "Restaurante" : "Buffet") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay paquetes disponibles</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>