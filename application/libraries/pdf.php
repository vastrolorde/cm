<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require('fpdf/fpdf.php');

class pdf extends FPDF
{
  // Extend FPDF using this class
  // More at fpdf.org -> Tutorials
  function __construct($orientation='P', $unit='mm', $size='A4')
  {
    // Call parent constructor
    parent::__construct($orientation,$unit,$size);
  }

  // Page header
	function Header()
	{
	    // Logo
	    // $this->Image('logo.png',10,6,30);
	    // Arial bold 15
	    $this->AddFont('angsa','','angsa.php');
	    $this->AddFont('angsa','B','angsab.php');
	    $this->AddFont('angsa','i','angsai.php');
	    $this->AddFont('angsa','z','angsaz.php');

	    $this->SetFont('angsa','B',32);

	    // Title
	    $this->Cell(0,10,'Classmat co., Ltd.',0,0,'C');
	    $this->Ln(8);

	    $this->SetFont('angsa','',20);
	    $this->Cell(0,10,iconv( 'UTF-8','TIS-620','บริษัท คลาสแมท จำกัด'),0,0,'C');
	    $this->Ln(8);

	    $this->SetFont('angsa','',14);
	    $this->Cell(0,10,iconv( 'UTF-8','TIS-620','เลขประจำตัวผู้เสียภาษี:'),0,0,'C');
	    $this->Ln(4);

	    $this->Cell(0,10,iconv( 'UTF-8','TIS-620','เลขที่ 93 ซอยอุดมสุข 51  ถนนสุขุมวิท'),0,0,'C');
	    $this->Ln(4);
	    $this->Cell(0,10,iconv( 'UTF-8','TIS-620','แขวงบางจาก  เขตพระโขนง  กรุงเทพฯ 10260'),0,0,'C');
	    // Line break
	    $this->Ln(10);
	}
}
?>