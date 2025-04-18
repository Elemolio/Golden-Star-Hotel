<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cajeros - Golden Star Hotel</title>
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
        <h1>Lista de Todos los Cajeros</h1>
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'ConexiónBD.php';

                $sql = "SELECT Usuario, Nombre, Apellido FROM cajero";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["Usuario"]. "</td><td>" . $row["Nombre"]. "</td><td>" . $row["Apellido"]. "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No se encontraron cajeros</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="gestion_cajero.html" class="button">Regresar</a>
    </div>
</body>
</html>
