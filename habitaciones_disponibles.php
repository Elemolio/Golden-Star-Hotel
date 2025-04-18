<?php
include 'ConexiónBD.php';

$sql = "SELECT No_Habitacion, Capacidad, Estado FROM habitacion WHERE Estado = 0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones Disponibles - Golden Star Hotel</title>
    <link rel="stylesheet" href="formstyle.css">
    
</head>
<body>
    <div class="container">
        <h2>Habitaciones Disponibles</h2>
        <table>
            <thead>
                <tr>
                    <th>Número de Habitación</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["No_Habitacion"] . "</td>";
                        echo "<td>" . $row["Capacidad"] . "</td>";
                        echo "<td>Disponible</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay habitaciones disponibles</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="reservar.html" class="button">Regresar</a>
    </div>
</body>
</html>
