<!doctype html ng-app>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Foundation | Welcome</title>

		<link rel="stylesheet" href="<?php echo asset_url().'bower/jquery-ui/themes/base/jquery-ui.css'; ?>">
		<link rel="stylesheet" href="<?php echo asset_url().'bower/foundation-sites/dist/foundation.min.css'; ?>">
		<link rel="stylesheet" href="<?php echo asset_url().'css/app.css'; ?>">
		<link rel="stylesheet" href="<?php echo asset_url().'css/foundation-icons.css'; ?>">

		<script src="<?php echo asset_url().'bower/jquery/dist/jquery.js'; ?>"></script>
		<script src="<?php echo asset_url().'bower/jquery-ui/jquery-ui.js'; ?>"></script>

	</head>
	<body id="login">
		<section id="panel">
			<article>
				<div>
					<h2>Classmat System</h2>
				</div>
				<div class="text-alert">
					<h3>Log out Suceessfully</h3>
				</div>
					<p>คุณกำลังกลับเข้าสู่หน้า Log in อัตโนมัติ ภายใน <span id="counter"></span> วินาที หรือกด <big><a href="<?php echo site_url().'/login' ?>">ที่นี่</a></big></p>
			</article>
			<p id="copyright" class="text-right">© Classmat 2016</p>
		</section>
	</body>

	<?php 

		header("Refresh: 5;http://localhost/cm/index.php/login");
	?>
	<script type="text/javascript">
		var seconds=5;// กำหนดค่าเริ่มต้น 10 วินาที

		$('#counter').text(seconds);//แสดงค่าเริ่มต้นใน 10 วินาที ใน text box
		
		function display(){ //function ใช้ในการ นับถอยหลัง
		
		seconds-=1;//ลบเวลาทีละหนึ่งวินาทีทุกครั้งที่ function ทำงาน
		
		if(seconds==-1){return;} //เมื่อหมดเวลาแล้วจะหยุดการทำงานของ function display
		
		$('#counter').text(seconds); //แสดงเวลาที่เหลือ
		setTimeout("display()",1000);// สั่งให้ function display() ทำงาน หลังเวลาผ่านไป 1000 milliseconds ( 1000  milliseconds = 1 วินาที )
		}
		display(); //เปิดหน้าเว็บให้ทำงาน function  display()
	</script>
</html>