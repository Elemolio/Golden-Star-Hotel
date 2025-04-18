<?php
include 'ConexiónBD.php';
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('logo.png', 10, 6, 15);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Informe de Huéspedes',0,1,'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function TablaHuespedes($header, $data)
    {
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        $w = array(40, 60, 60, 90);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row['ID_huesped'],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row['Nombre'],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row['Apellido'],'LR',0,'L',$fill);
            $this->Cell($w[3],6,$row['Correo'],'LR',0,'L',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}

$sql = "SELECT * FROM Huesped";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$header = array('ID Huésped', 'Nombre', 'Apellido', 'Correo');
$pdf->TablaHuespedes($header, $data);
$pdf->Output();
?>
