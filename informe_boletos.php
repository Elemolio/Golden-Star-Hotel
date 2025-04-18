<?php
include 'ConexiónBD.php';
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('logo.png', 10, 6, 15);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Informe de Boletos',0,1,'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function TablaBoletos($header, $data)
    {
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        $w = array(30, 30, 30, 30, 30, 30);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row['ID_boleto'],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row['Cajero'],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row['Cliente'],'LR',0,'L',$fill);
            $this->Cell($w[3],6,$row['Producto'],'LR',0,'L',$fill);
            $this->Cell($w[4],6,$row['Precio'],'LR',0,'L',$fill);
            $this->Cell($w[5],6,$row['Caducidad'],'LR',0,'L',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}

$sql = "SELECT * FROM Boleto";
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

$header = array('ID Boleto', 'Cajero', 'Cliente', 'Producto', 'Precio', 'Caducidad');
$pdf->TablaBoletos($header, $data);
$pdf->Output();
?>
