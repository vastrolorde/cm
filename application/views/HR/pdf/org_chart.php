<?php
    $this->pdf->AddPage();
    $this->pdf->SetFont('Arial','B',16);
    $this->pdf->Cell(40,10,'Hello World!');
    $this->pdf->Output();
?>