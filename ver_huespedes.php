<?php
include 'ConexiónBD.php';

$sql = "SELECT * FROM vista_huespedes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Todos los Huéspedes - Golden Star Hotel</title>
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
            text-align: left;
        }
        th {
            background-color: #007bff;
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
        <h1>Lista de Todos los Huéspedes</h1>
        <table>
            <tr>
                <th>ID Huésped</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>ID Boleto</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID_huesped"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["Apellido"] . "</td>";
                    echo "<td>" . $row["Correo"] . "</td>";
                    echo "<td>" . $row["ID_boleto"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay huéspedes registrados</td></tr>";
            }
            ?>
        </table>
        <a href="gestion_huesped.html" class="button">Regresar</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>