<?php
include 'ConexiónBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_plan = $_POST['ID_entretenimiento'];

    // Eliminar las referencias en la tabla paquete
    $sql_paquete = "DELETE FROM Paquete WHERE Plan_entretenimiento = ?";
    $stmt_paquete = $conn->prepare($sql_paquete);
    $stmt_paquete->bind_param('i', $id_plan);
    $stmt_paquete->execute();
    $stmt_paquete->close();

    // Ahora eliminar el plan de entretenimiento
    $sql = "DELETE FROM Plan_entretenimiento WHERE ID_entretenimiento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_plan);
    if ($stmt->execute() === TRUE) {
        echo "Plan de entretenimiento eliminado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
</head>
<body>
    <a href="gestion_planes.html">Regresar</a>
</body>
</html>