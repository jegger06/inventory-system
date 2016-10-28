<?php
	
	session_start();
	if (empty($_SESSION['user_id'])) {
		header('Location: login');
	}
	require '../controller/helpers/generate_password.php';
	
	$pass = randomPassword();

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
	<!-- ANIMATE.CSS-->
	<link rel="stylesheet" href="/assets/css/animate.min.css">
	<!-- WHIRL (spinners)-->
	<link rel="stylesheet" href="/assets/css/whirl.css">
	<!-- =============== PAGE VENDOR STYLES ===============-->
	<!-- =============== BOOTSTRAP STYLES ===============-->
	<link rel="stylesheet" href="/assets/css/bootstrap.css" id="bscss">
	<!-- =============== APP STYLES ===============-->
	<link rel="stylesheet" href="/assets/css/app.css" id="maincss">
</head>
<body>
	<div class="wrapper">
		<!-- top navbar-->
		<?php include '../controller/includes/header.php'; ?>
		<!-- sidebar-->
		<?php include '../controller/includes/sidebar.php'; ?>
		<!-- offsidebar-->
		<!-- Main section-->
		<section>
			<!-- Page content-->
			<div class="content-wrapper">
				<h3>Add User
					<small></small>
				</h3>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">Register a User</div>
							<div class="panel-body">
								<form role="form" id="registration_form">
									<div class="form-group">
										<label>User Name</label>
										<input type="text" placeholder="Enter User Name" name="user_name" class="form-control username validate" required>
									</div>
									<div class="form-group">
										<label>Email address</label>
										<input type="email" placeholder="Enter email" name="email" class="form-control email validate" required>
									</div>
									<div class="form-group">
										<label>First Name</label>
										<input type="text" placeholder="Enter First Name" name="first_name" class="form-control fullname validate" required>
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" placeholder="Enter Last Name" name="last_name" class="form-control fullname validate" required>
									</div>
									<div class="form-group">
										<label>Department</label>
										<select name="department" id="department" class="form-control" required>
											<option value="">Select</option>
										</select>
									</div>
									<div class="form-group">
										<label>Position</label>
										<select name="position" id="position" class="form-control" required>
											<option value="">Select</option>
										</select>
									</div>
									<div class="form-group">
										<label class="pass">Password</label>
										<button type="button" id="show_pass" class="btn btn-sm btn-default mb">Show password</button>
										<div class="password_holder row">
											<div class="col-sm-6">
												<input type="text" name="password" id="password" placeholder="Password" class="form-control" value="<?php echo trim($pass); ?>">
											</div>
											<div class="col-sm-6">
												<button type="button" id="hide_pass" class="btn btn-sm btn-default"><em class="fa fa-eye"></em>Hide</button>
												<button type="button" id="cancel_pass" class="btn btn-sm btn-default">Cancel</button>
											</div>
										</div>
									</div>
									<button type="submit" id="register_btn" class="btn btn-sm btn-primary">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Page footer-->
		<?php include '../controller/includes/footer.php'; ?>
	</div>
	<!-- =============== VENDOR SCRIPTS ===============-->
	<!-- MODERNIZR-->
	<script src="/assets/js/modernizr.custom.js"></script>
	<!-- MATCHMEDIA POLYFILL-->
	<script src="/assets/js/matchMedia.js"></script>
	<!-- JQUERY-->
	<script src="/assets/js/jquery.js"></script>
	<!-- BOOTSTRAP-->
	<script src="/assets/js/bootstrap.js"></script>
	<!-- STORAGE API-->
	<script src="/assets/js/jquery.storageapi.js"></script>
	<!-- JQUERY EASING-->
	<script src="/assets/js/jquery.easing.js"></script>
	<!-- ANIMO-->
	<script src="/assets/js/animo.js"></script>
	<!-- SLIMSCROLL-->
	<script src="/assets/js/jquery.slimscroll.min.js"></script>
	<!-- SCREENFULL-->
	<script src="/assets/js/screenfull.js"></script>
	<!-- LOCALIZE-->
	<!-- <script src="/assets/js/jquery.localize.js"></script> -->
	<!-- RTL demo-->
	<script src="/assets/js/demo-rtl.js"></script>
	<!-- =============== PAGE VENDOR SCRIPTS ===============-->
	<!-- =============== APP SCRIPTS ===============-->
	<script src="/assets/js/app.js"></script>
	<script src="/app/model/user/js/user_details.js"></script>
	<script src="/assets/js/nav_active.js"></script>
	<script src="/assets/js/simply-toast.min.js"></script>
	<script src="/app/model/user/js/logout.js"></script>
	<script src="/app/model/user/js/add_user.js"></script>
</body>
</html>