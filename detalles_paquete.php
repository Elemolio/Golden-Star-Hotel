<?php
include 'ConexiónBD.php';

if (isset($_GET['id_paquete'])) {
    $id_paquete = $_GET['id_paquete'];

    // Consulta para obtener los detalles del paquete, incluyendo la descripción del entretenimiento
    $sql = "
        SELECT 
            p.ID_paquete,
            p.nombre_entretenimiento,
            CASE 
                WHEN p.Plan_comida = 1 THEN 'Restaurante' 
                ELSE 'Buffet' 
            END AS Plan_comida,
            e.Descripcion AS descripcion_entretenimiento
        FROM 
            vistapaquetes p
        LEFT JOIN 
            vista_planes e ON p.nombre_entretenimiento = e.Nombre
        WHERE 
            p.ID_paquete = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_paquete);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontraron detalles para este paquete.";
        exit();
    }

    $stmt->close();
} else {
    echo "ID de paquete no especificado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Paquete</title>
    <link rel="stylesheet" href="formstyle.css">
    <style>
        body {
            background: url('https://cf.bstatic.com/xdata/images/hotel/max1024x768/406807699.jpg?k=ab5e55e4bcca6b415a216b14e83c5164e1a022f688e404a53b1a21830ada0571&o=&hp=1') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 60%;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .button {
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            display: inline-block;
        }
        h1 {
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles del Paquete</h1>
        <p><strong>Paquete:</strong> <?php echo $row['ID_paquete']; ?></p>
        <p><strong>Plan de Entretenimiento:</strong> <?php echo $row['nombre_entretenimiento']; ?></p>
        <p><strong>Descripción del Entretenimiento:</strong> <?php echo $row['descripcion_entretenimiento'] ?? 'No disponible'; ?></p>
        <p><strong>Plan de Comida:</strong> <?php echo $row['Plan_comida']; ?></p>
        <a href="reservar.php?id_paquete=<?php echo $row['ID_paquete']; ?>" class="button">Reservar</a>
        <a href="dashboard.php" class="button">Regresar</a>
    </div>
</body>
</html>




