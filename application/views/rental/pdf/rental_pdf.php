<?php
		$this->pdf->AddPage();
		$this->pdf->SetLeftMargin(10);
		$this->pdf->SetRightMargin(10);
		$this->pdf->SetAutoPageBreak(true,5);

		//Set font
	    $this->pdf->AddFont('angsa','','angsa.php');
	    $this->pdf->AddFont('angsa','B','angsab.php');
	    $this->pdf->AddFont('angsa','i','angsai.php');
	    $this->pdf->AddFont('angsa','z','angsaz.php');
	    
		$this->pdf->SetFont('angsa','',36);

		//SubHeader
		$this->pdf->Cell(0,12,iconv( 'UTF-8','TIS-620','ใบเช่าสินค้า'),0,1,"C");

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
		/*4*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620','เอกสารอ้างอิง :'),0,0,'R');
		/*4*/	$this->pdf->Cell(20,20,iconv( 'UTF-8','TIS-620',$data[0]->ref_doc),0,0,'L');
		/*5*/	$this->pdf->Ln(18);

				$this->pdf->Cell(192,6,iconv( 'UTF-8','TIS-620','ระยะเวลาสัญญา'),1,0,'C');
				$this->pdf->Ln();
				$this->pdf->Cell(64,8,iconv( 'UTF-8','TIS-620','เริ่มสัญญา : '.$data[0]->start),1,0,'L');
				$this->pdf->Cell(64,8,iconv( 'UTF-8','TIS-620','สิ้นสุดสัญญา : '.$data[0]->exp),1,0,'L');
				$this->pdf->Cell(64,8,iconv( 'UTF-8','TIS-620','ระยะเวลาสัญญาทั้งสิ้น : '.$data[0]->duration.' วัน'),1,0,'L');
				$this->pdf->Ln(15);

			// rental_tr
		$this->pdf->SetFont('angsa','B',12);
				$this->pdf->Cell(8,10,iconv( 'UTF-8','TIS-620','no.'),1,0,'C');
				$this->pdf->Cell(22,10,iconv( 'UTF-8','TIS-620','รหัสสินค้า'),1,0,'C');
				$this->pdf->Cell(40,10,iconv( 'UTF-8','TIS-620','รายละเอียด'),1,0,'C');
				$this->pdf->Cell(15,10,iconv( 'UTF-8','TIS-620','จำนวน'),1,0,'C');
				$this->pdf->Cell(12,10,iconv( 'UTF-8','TIS-620','นน./ชิ้น'),1,0,'C');
				$this->pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','ค่าค้ำประกัน/ชิ้น/สัญญา'),1,0,'C');
				$this->pdf->Cell(29,10,iconv( 'UTF-8','TIS-620','รวมค่าค้ำประกัน/สัญญา'),1,0,'C');;
				$this->pdf->Cell(18,10,iconv( 'UTF-8','TIS-620','ค่าเช่า/ชิ้น/วัน'),1,0,'C');
				$this->pdf->Cell(18,10,iconv( 'UTF-8','TIS-620','รวมค่าเช่า/วัน'),1,0,'C');
				$this->pdf->Ln();

		$this->pdf->SetFont('angsa','',12);

		$i = 1;
		$total_rental = 0;
		$total_guarant = 0;
		foreach($rental_tr as $row){

				$amount = $row->amount;
				$rental = $row->product_d_RentalPrice;
				$guarant = $row->product_GuaranteePrice;

				$this->pdf->Cell(8,6,iconv( 'UTF-8','TIS-620',$i),1,0,'C');
				$this->pdf->Cell(22,6,iconv( 'UTF-8','TIS-620',$row->product_id),1,0,'C');
				$this->pdf->Cell(40,6,iconv( 'UTF-8','TIS-620//TRANSLIT',$row->product_name),1,0,'C');
				$this->pdf->Cell(15,6,iconv( 'UTF-8','TIS-620',number_format($amount,2,'.',',')),1,0,'C');
				$this->pdf->Cell(12,6,iconv( 'UTF-8','TIS-620',number_format($row->product_weight,2,'.',',')),1,0,'C');
				$this->pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',number_format($guarant,2,'.',',')),1,0,'C');
				$this->pdf->Cell(29,6,iconv( 'UTF-8','TIS-620',number_format($amount*$guarant,2,'.',',')),1,0,'C');
				$this->pdf->Cell(18,6,iconv( 'UTF-8','TIS-620',number_format($rental,2,'.',',')),1,0,'C');
				$this->pdf->Cell(18,6,iconv( 'UTF-8','TIS-620',number_format($amount*$rental,2,'.',',')),1,0,'C');
				$this->pdf->Ln();

				$total_rental += $amount*$rental;
				$total_guarant += $amount*$guarant;
		$i++;
		}

				//Total

				$this->pdf->SetFont('angsa','B',12);
				$this->pdf->Cell(97,7,iconv( 'UTF-8','TIS-620',''),0,0,'R');
				$this->pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','รวมค้ำประกัน/สัญญา'),1,0,'R');
				$this->pdf->Cell(29,7,iconv( 'UTF-8','TIS-620',number_format($total_guarant,2,'.',',')),1,0,'L');
				$this->pdf->Cell(18,7,iconv( 'UTF-8','TIS-620','รวมค่าเช่า/วัน'),1,0,'R');
				$this->pdf->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($total_rental,2,'.',',')),1,0,'L');
				$this->pdf->Ln();
				
				$this->pdf->Cell(127,7,iconv( 'UTF-8','TIS-620','ประเภทการรับเงิน: '.$data[0]->guaranteeType),0,0,'L');
				$this->pdf->Cell(47,7,iconv( 'UTF-8','TIS-620','รวมค่าเช่าตลอดระยะเวลาสัญญา'),1,0,'R');
				$this->pdf->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($total_rental*$data[0]->duration,2,'.',',') ),1,0,'L');
				$this->pdf->Ln();
				
				$this->pdf->Cell(127,7,iconv( 'UTF-8','TIS-620','ธนาคาร: '.$data[0]->bankname.'     สาขา: '.$data[0]->branch),0,0,'L');
				$this->pdf->Cell(47,7,iconv( 'UTF-8','TIS-620','ส่วนลด'),1,0,'R');
				$this->pdf->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data[0]->discount,2,'.',',') ),1,0,'L');
				$this->pdf->Ln();
				
				$this->pdf->Cell(127,7,iconv( 'UTF-8','TIS-620','เลขที่บัญชี: '.$data[0]->Acc_no),0,0,'L');
				$this->pdf->Cell(47,7,iconv( 'UTF-8','TIS-620','สุทธิก่อน VAT'),1,0,'R');
				$this->pdf->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format( ($total_rental*$data[0]->duration)-$data[0]->discount,2,'.',',')  ),1,0,'L');
				$this->pdf->Ln();
				
				$this->pdf->Cell(127,7,iconv( 'UTF-8','TIS-620','ลงวันที่: '.$data[0]->trDate),0,0,'L');
				$this->pdf->Cell(47,7,iconv( 'UTF-8','TIS-620','ภาษีมูลค่าเพิ่ม'),1,0,'R');
				$this->pdf->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data[0]->VAT,2,'.',',')),1,0,'L');
				$this->pdf->Ln();

				$this->pdf->Cell(127,7,iconv( 'UTF-8','TIS-620','เลขที่เช็ค/เลขที่อ้างอิง: '.$data[0]->tranferNote),0,0,'L');
				$this->pdf->Cell(47,7,iconv( 'UTF-8','TIS-620','สุทธิ'),1,0,'R');
				$this->pdf->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data[0]->grandtotal,2,'.',',')),1,0,'L');

				//Remark

				$this->pdf->Ln();
				$this->pdf->Cell(165,10,iconv( 'UTF-8','TIS-620','หมายเหตุ'),0,0,'L');
				$this->pdf->Ln(7);

				$this->pdf->SetFont('angsa','',12);
				$this->pdf->Cell(165,10,iconv( 'UTF-8','TIS-620','- กรุณาแจ้งล่วงหน้าก่อนมาคืนของอย่างน้อย 3 วันทำการ บริษัทเปิดทำการจันทร์ - เสาร์ 8:00 -17:00 พักเที่ยง 12:00-13:00 (หรือสอบถามเพิ่มเติมอีกครั้ง)'),0,0,'L');
				$this->pdf->Ln(5);
				$this->pdf->Cell(165,10,iconv( 'UTF-8','TIS-620','- ลูกค้าคืนของนอกเวลางาน คิดค่าบริการเพิ่มตามน้ำหนักสินค้า กก. ละ 2 บาท '),0,0,'L');
				$this->pdf->Ln(5);
				$this->pdf->Cell(165,10,iconv( 'UTF-8','TIS-620','- หากลูกค้าเช่าเกิน จากระยะเวลาสัญญา ทางบริษัทขอสงวนสิทธิ์คิดราคาค่าเช่าต่อวันที่ราคา '.number_format($total_rental,2,'.',',').' บาท/วัน'),0,0,'L');
				$this->pdf->Ln(5);
				$this->pdf->Cell(165,10,iconv( 'UTF-8','TIS-620','- บริษัทยินดีคืนค้ำประกันครบถ้วนสมบูรณ์ตามจำนวนที่ลูกค้ามอบให้ เว้นแต่'),0,0,'L');
				$this->pdf->Ln(5);
				$this->pdf->Cell(5,10,iconv( 'UTF-8','TIS-620',''),0,0,'L');
				$this->pdf->Cell(160,10,iconv( 'UTF-8','TIS-620','- สินค้าสูญหาย เสียหาย คิดตามมูลค่าค้ำประกันรายชิ้น'),0,0,'L');
				$this->pdf->Ln(5);
				$this->pdf->Cell(5,10,iconv( 'UTF-8','TIS-620',''),0,0,'L');
				$this->pdf->Cell(160,10,iconv( 'UTF-8','TIS-620','- สินค้าเลอะปูน สนิมขึ้น เลอะสี ทำสีใหม่ มากกว่า 50% ของสภาพพร้อมใช้งาน คิด 30% ของมูลค่าค้ำประกันรายชิ้น'),0,0,'L');
				$this->pdf->Ln(5);
				$this->pdf->Cell(165,10,iconv( 'UTF-8','TIS-620','- หากบริษัทไม่สามารถติดต่อท่านได้หลังจากเกินวันครบกำหนดสัญญานาน 90 วัน บริษัทขอสงวนสิทธิ์คืนค้ำประกันและถือว่าสัญญาเช่าสิ้นสุด'),0,0,'L');
				$this->pdf->Ln(20);


				//Sign

				$this->pdf->Cell(5);
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','_________________________'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','_________________________'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','_________________________'),0,0,'C');
				$this->pdf->Cell(5);
				$this->pdf->Ln(8);

				$this->pdf->Cell(5);
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(_________________________)'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(_________________________)'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(_________________________)'),0,0,'C');
				$this->pdf->Cell(5);
				$this->pdf->Ln(8);


				$this->pdf->Cell(5);
				$this->pdf->Cell(60,8,iconv( 'UTF-8','TIS-620','ผู้จัดทำ'),0,0,'C');
				$this->pdf->Cell(60,8,iconv( 'UTF-8','TIS-620','ผู้รับ'),0,0,'C');
				$this->pdf->Cell(60,8,iconv( 'UTF-8','TIS-620','ผู้คืน'),0,0,'C');
				$this->pdf->Cell(5);
				$this->pdf->Ln(4);


				$this->pdf->Cell(5);
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____/________/________)'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____/________/________)'),0,0,'C');
				$this->pdf->Cell(60,12,iconv( 'UTF-8','TIS-620','(____/________/________)'),0,0,'C');
				$this->pdf->Cell(5);
		$this->pdf->Output();
