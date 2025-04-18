<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Boletos - Golden Star Hotel</title>
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
        .container {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Todos los Boletos</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Boleto</th>
                    <th>Cajero</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Caducidad</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>No. Habitación</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th>Plan de Entretenimiento</th>
                    <th>Plan de Comida</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'ConexiónBD.php';

                $sql = "SELECT * FROM vistaboletoscompleta";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["ID_boleto"]. "</td>
                                <td>" . $row["Cajero"]. "</td>
                                <td>" . $row["Cliente"]. "</td>
                                <td>" . $row["Producto"]. "</td>
                                <td>" . $row["Precio"]. "</td>
                                <td>" . $row["Caducidad"]. "</td>
                                <td>" . $row["Fecha_Inicio"]. "</td>
                                <td>" . $row["Fecha_final"]. "</td>
                                <td>" . $row["No_Habitacion"]. "</td>
                                <td>" . $row["Capacidad"]. "</td>
                                <td>" . $row["Estado"]. "</td>
                                <td>" . $row["Plan_entretenimiento"]. "</td>
                                <td>" . $row["Plan_comida"]. "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No se encontraron boletos</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="gestion_boleto.html" class="button">Regresar</a>
    </div>
</body>
</html>

