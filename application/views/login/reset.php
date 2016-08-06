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
				<form>
					<label>Login:
						<input type="text" name="login">
					</label>
					<label>new Password:
						<input type="password" name="password">
					</label>
					<label>confirm new Password:
						<input type="password" name="password">
					</label>

					<div class="text-center">
						<button class="button">Reset</button>
						<a class="button alert" href="<?php echo site_url('login') ?>">ย้อนกลับ</a>
					</div>
				</form>
			</article>
			<p id="copyright" class="text-right">© Classmat 2016</p>
		</section>
	</body>
</html>