<?php 

session_start();

require '../controller/db/connect.php';

if (isset($_SESSION['user_id'])) {
	header('Location: admin');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Bootstrap Admin App + jQuery">
	<meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
	<title>Angle - Bootstrap Admin Template</title>
	<!-- =============== VENDOR STYLES ===============-->
	<!-- FONT AWESOME-->
	<link rel="stylesheet" href="/assets/fontawesome/css/font-awesome.min.css">
	<!-- SIMPLE LINE ICONS-->
	<link rel="stylesheet" href="/assets/simple-line-icons/css/simple-line-icons.css">
	<!-- =============== BOOTSTRAP STYLES ===============-->
	<link rel="stylesheet" href="/assets/css/bootstrap.css" id="bscss">
	<!-- =============== APP STYLES ===============-->
	<link rel="stylesheet" href="/assets/css/app.css" id="maincss">
	<link rel="stylesheet" href="/assets/css/simply-toast.min.css">
</head>
<body>
	<div class="wrapper">
		<div class="block-center mt-xl wd-xl">
			<!-- START panel-->
			<div class="panel panel-dark panel-flat">
				<div class="panel-heading text-center">
					<a href="#">
						<img src="/assets/img/logo.png" alt="Image" class="block-center img-rounded">
					</a>
				</div>
				<div class="panel-body">
					<p class="text-center pv">SIGN IN TO CONTINUE.</p>
					<?php
						if (isset($_COOKIE['userID'])) {	
							$userID = $_COOKIE['userID'];						
							$query = mysqli_query($conn, "SELECT `user_name`, `user_password` FROM `tbl_user_info` WHERE `user_id` = $userID LIMIT 1");
							$row = mysqli_fetch_assoc($query);
							$username = $row['user_name'];
							$h_password = $row['user_password'];
						}
					?>
					<form role="form" id="login_form" class="mb-lg">
						<div class="form-group has-feedback">
							<input id="username" type="text" placeholder="Enter User Name" value="<?php if (isset($_COOKIE['userID'])) { echo $username; } else { echo ''; } ?>" autocomplete="off" required class="form-control">
							<span class="fa fa-user form-control-feedback text-muted"></span>
						</div>
						<div class="form-group has-feedback">
							<input id="password" type="password" placeholder="Password" required class="form-control" pattern=".{4,}" title="4 characters minimum">
							<span class="fa fa-lock form-control-feedback text-muted"></span>
						</div>
						<div class="clearfix">
							<div class="checkbox c-checkbox pull-left mt0">
								<label>
									<input type="checkbox" <?php if (isset($_COOKIE['userID'])) { echo 'checked'; } else { echo ''; } ?> value="" id="remember" name="remember">
									<span class="fa fa-check"></span>Remember Me</label>
							</div>
							<div class="pull-right"><a href="recover" class="text-muted">Forgot your password?</a>
							</div>
						</div>
						<button type="submit" class="btn btn-block btn-primary mt-lg" id="login">Login</button>
					</form>
					<p class="pt-lg text-center">Need to Signup?</p><a href="register" class="btn btn-block btn-default">Register Now</a>
				</div>
			</div>
			<!-- END panel-->
			<div class="p-lg text-center">
				<span>&copy;</span>
				<span>2016</span>
				<span>-</span>
				<span>Angle</span>
				<br>
				<span>Bootstrap Admin Template</span>
			</div>
		</div>
	</div>
	<!-- =============== VENDOR SCRIPTS ===============-->
	<!-- MODERNIZR-->
	<script src="/assets/js/modernizr.custom.js"></script>
	<!-- JQUERY-->
	<script src="/assets/js/jquery.js"></script>
	<!-- BOOTSTRAP-->
	<script src="/assets/js/bootstrap.js"></script>
	<!-- STORAGE API-->
	<script src="/assets/js/jquery.storageapi.js"></script>
	<!-- PARSLEY-->
	<!-- <script src="/assets/js/parsley.min.js"></script> -->
	<!-- =============== APP SCRIPTS ===============-->
	<script src="/assets/js/simply-toast.min.js"></script>
	<script src="/app/model/user/js/login.js"></script>
</body>
</html>