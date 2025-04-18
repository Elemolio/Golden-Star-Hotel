<?php
include 'ConexiónBD.php';

$sql = "SELECT * FROM vistapaquetes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Todos los Paquetes - Golden Star Hotel</title>
    <link rel="stylesheet" href="formstyle.css">
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .button {
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            display: block;
            width: 200px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Paquetes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Paquete</th>
                    <th>Nombre Entretenimiento</th>
                    <th>Plan Comida</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ID_paquete"] . "</td>";
                        echo "<td>" . $row["nombre_entretenimiento"] . "</td>";
                        echo "<td>" . ($row["Plan_comida"] == 1 ? "Restaurante" : "Buffet"). "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No se encontraron paquetes</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="gestion_paquetes.html" class="button">Regresar</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>

