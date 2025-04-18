<?php
include 'ConexiónBD.php';
require('fpdf.php');

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        // Logo
        $this->Image('logo.png', 10, 6, 15); // Asegúrate de que 'logo.png' esté en el subdirectorio 'images'
        $this->SetFont('Arial','B',12);
        // Título
        $this->Cell(0,10,'Informe de Paquetes',0,1,'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Tabla de Paquetes
    function TablaPaquetes($header, $data)
    {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Anchuras de las columnas
        $w = array(40, 90, 60);
        // Encabezados
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Datos
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row['ID_paquete'],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row['nombre_entretenimiento'],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row['Plan_comida'],'LR',0,'L',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w),0,'','T');
    }
}

// Obtener datos de la base de datos
$sql = "SELECT * FROM VistaPaquetes";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

// Crear un nuevo PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// Encabezados de la tabla
$header = array('ID Paquete', 'Plan de Entretenimiento', 'Plan de Comida');

// Cargar datos
$pdf->TablaPaquetes($header, $data);
$pdf->Output();
?>

