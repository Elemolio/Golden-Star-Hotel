<?php
include 'ConexiónBD.php';

$sql = "SELECT * FROM vista_habitaciones";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Todas las Habitaciones - Golden Star Hotel</title>
    <link rel="stylesheet" href="formstyle.css">
    <style>
        .container {
            width: 95%;
            margin: 0 auto;
            overflow-x: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 10px; /* Ajusta el tamaño de la fuente */
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 4px; /* Reduce el padding para ajustar más contenido */
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 8px;
            background-color: #6c757d;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Habitaciones</h2>
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
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["No_Habitacion"] . "</td>";
                        echo "<td>" . $row["Capacidad"] . "</td>";
                        echo "<td>" . $row["Estado"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No se encontraron habitaciones</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="gestion_habitacion.html" class="button">Regresar</a>
    </div>
</body>
</html>


