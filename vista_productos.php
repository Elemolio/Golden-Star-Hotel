<?php
include 'ConexiónBD.php';

$sql = "SELECT * FROM vistaproductoshabitaciones";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Productos y Entretenimiento - Golden Star Hotel</title>
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
        <h2>Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Número Habitación</th>
                    <th>Paquete</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . (isset($row["ID_producto"]) ? $row["ID_producto"] : "N/A") . "</td>";
                        echo "<td>" . (isset($row["No_Habit"]) ? $row["No_Habit"] : "N/A") . "</td>";
                        echo "<td>" . (isset($row["Paquete"]) ? $row["Paquete"] : "N/A") . "</td>";
                        echo "<td>" . (isset($row["Fecha_Inicio"]) ? $row["Fecha_Inicio"] : "N/A") . "</td>";
                        echo "<td>" . (isset($row["Fecha_final"]) ? $row["Fecha_final"] : "N/A") . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay productos disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="gestion_producto.html" class="button">Regresar</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>

