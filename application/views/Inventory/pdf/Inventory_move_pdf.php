<?php
		$this->pdf->AddPage();

		//Set font
	    $this->pdf->AddFont('angsa','','angsa.php');
	    $this->pdf->AddFont('angsa','B','angsab.php');
	    $this->pdf->AddFont('angsa','i','angsai.php');
	    $this->pdf->AddFont('angsa','z','angsaz.php');
	    
		$this->pdf->SetFont('angsa','',36);

		//SubHeader
		$this->pdf->Cell(0,12,iconv( 'UTF-8','TIS-620','ใบรับ/เบิกสินค้า'),0,1,"C");

		$this->pdf->SetFont('angsa','B',14);
		/*1*/	$this->pdf->Cell(30,20,iconv( 'UTF-8','TIS-620','ชื่อลูกค้า :'),0,0,'R');
		/*2*/	$this->pdf->Cell(60,20,iconv( 'UTF-8','TIS-620',$data[0]->partner_name.'('.$data[0]->partner_id.')'),0,0,'L');
		/*3*/	$this->pdf->Cell(40);
		/*4*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620','เลขที่เอกสาร :'),0,0,'R');
		/*5*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620',$data[0]->id),0,0,'L');
		/*6*/	$this->pdf->Ln(6);

		/*1*/	$this->pdf->Cell(30,20,iconv( 'UTF-8','TIS-620','เบอร์ติดต่อ :'),0,0,'R');
		/*2*/	$this->pdf->Cell(60,20,iconv( 'UTF-8','TIS-620',$data[0]->tel),0,0,'L');
		/*3*/	$this->pdf->Cell(40);
		/*4*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620','วันที่เอกสาร :'),0,0,'R');
		/*5*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620',$data[0]->create_date),0,0,'L');
		/*6*/	$this->pdf->Ln(6);

		/*1*/	$this->pdf->Cell(30,20,iconv( 'UTF-8','TIS-620','e-mail :'),0,0,'R');
		/*2*/	$this->pdf->Cell(60,20,iconv( 'UTF-8','TIS-620',$data[0]->email),0,0,'L');
		/*3*/	$this->pdf->Cell(40);
		/*4*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620','ชนิดรายการ :'),0,0,'R');
		/*4*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620',$data[0]->invent_move_type),0,0,'L');
		/*5*/	$this->pdf->Ln(6);

		/*1*/	$this->pdf->Cell(130);
		/*2*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620','สถานะเอกสาร :'),0,0,'R');
		/*3*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620',$data[0]->invent_move_status),0,0,'L');
		/*4*/	$this->pdf->Ln(24);

			// invent_tr

				$this->pdf->Cell(10,10,iconv( 'UTF-8','TIS-620','no.'),1,0,'C');
				$this->pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','รหัสสินค้า'),1,0,'C');
				$this->pdf->Cell(80,10,iconv( 'UTF-8','TIS-620','รายละเอียด'),1,0,'C');
				$this->pdf->Cell(20,10,iconv( 'UTF-8','TIS-620','จำนวน'),1,0,'C');
				$this->pdf->Cell(20,10,iconv( 'UTF-8','TIS-620','น้ำหนัก/ชิ้น'),1,0,'C');
				$this->pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','รวม'),1,0,'C');
				$this->pdf->Ln();

		$i = 1;
		$this->pdf->SetFont('angsa','',14);
		$grandtotal = 0;
		foreach($invent_tr as $row){
				$total = $row->product_weight*$row->amount;
				$grandtotal += $total;

				$this->pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$i),1,0,'C');
				$this->pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row->product_id),1,0,'C');
				$this->pdf->Cell(80,6,iconv( 'UTF-8','TIS-620//TRANSLIT',$row->product_name),1,0,'C');
				$this->pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row->amount),1,0,'C');
				$this->pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row->product_weight),1,0,'C');
				$this->pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$total),1,0,'C');
				$this->pdf->Ln();
		$i++;
		}

				$this->pdf->SetFont('angsa','B',14);
				$this->pdf->Cell(160,10,iconv( 'UTF-8','TIS-620','รวมน้ำหนักทั้งหมด'),1,0,'R');
				$this->pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',$grandtotal),1,0,'C');
				$this->pdf->Ln(20);

				$this->pdf->Cell(190,10,iconv( 'UTF-8','TIS-620','ข้าพเจ้าขอยืนยันว่า จำนวนที่ส่งมอบนั่น ถูกต้องครบถ้วนทุกประการ'),0,0,'L');
				$this->pdf->Ln(20);

				$this->pdf->Cell(5);
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','____________________'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','____________________'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','____________________'),0,0,'C');
				$this->pdf->Cell(5);
				$this->pdf->Ln(8);

				$this->pdf->Cell(5);
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____________________)'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____________________)'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____________________)'),0,0,'C');
				$this->pdf->Cell(5);
				$this->pdf->Ln(8);


				$this->pdf->Cell(5);
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','ผู้จัดทำ'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','ผู้รับ'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','ผู้คืน'),0,0,'C');
				$this->pdf->Cell(5);
				$this->pdf->Ln(8);


				$this->pdf->Cell(5);
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____/________/________)'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____/________/________)'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____/________/________)'),0,0,'C');
				$this->pdf->Cell(5);
		$this->pdf->Output();
