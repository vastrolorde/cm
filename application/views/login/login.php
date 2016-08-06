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

	</head>
	<body id="login">
		<section id="panel">
			<article>
				<div>
					<h2>Classmat System
					<small><?php echo $title; ?></small></h2>
				</div>
				<div class="text-alert">
					<?php
						if(isset($_SESSION['error_msg'])){
							echo $_SESSION['error_msg'];
						}
					?>
				</div>
				<?php
						echo form_open('/login/login');

						$production = TRUE;

						if($production == TRUE){
							$username = 'admin@admin.com';
							$password = 'password';
						}else{
							$username = '';
							$password = '';
						}
					?>
					<label>Login:
						<input type="text" name="login" value="<?php echo $username; ?>">
					</label>
					<label>Password:
						<input type="password" name="password" value="<?php echo $password; ?>">
					</label>

					<div class="text-center"><button class="button">Login</button>
						<p>ลืมรหัสผ่าน? <a href="<?php echo site_url('login/reset') ?>">กดเลย</a></p>
					</div>
				</form>
			</article>
			<p id="copyright" class="text-right">© Classmat 2016</p>
		</section>
	</body>
</html>