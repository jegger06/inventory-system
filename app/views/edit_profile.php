<?php 

	session_start();
	if (empty($_SESSION['user_id'])) {
		header('Location: login');
	}
	require '../controller/helpers/generate_title.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Bootstrap Admin App + jQuery">
	<meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
	<title>Angle - <?php echo title(); ?></title>
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
	<!-- SWEET ALERT-->
	<link rel="stylesheet" href="/assets/css/sweetalert.css">
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
				<h3><?php echo title(); ?>
					<small><span class="user_id hide"><?php echo $_SESSION['user_id']; ?></span></small>
				</h3>
				<div class="row">
					<div class="col-md-3">
						<div class="panel b">
							<div class="panel-heading bg-gray-lighter text-bold">
								Personal Settings
							</div>
							<div class="list-group tabs">
								<a href="#profile" class="list-group-item act" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
								<a href="#account" class="list-group-item" aria-controls="account" role="tab" data-toggle="tab">Account</a>
								<a href="#contact" class="list-group-item" aria-controls="contact" role="tab" data-toggle="tab">Contact Details</a>
							</div>
						</div>
					</div>
					<div class="col-md-9 edit_profile">
						<div class="tab-content p0 b0">
							<div role="tabpanel" class="tab-pane active" id="profile">
								<div class="panel b">
									<div class="panel-heading bg-gray-lighter text-bold">
										Profile
									</div>
									<div class="panel-body">
										<form class="profile_form" autocomplete="off">
											<div class="form-group">
												<label for="profile_pic">Picture</label>
												<input type="file" name="profile_pic" id="profile_pic" data-input="true" data-classbutton="btn btn-default" data-classinput="form-control inline" data-buttontext="Upload picture" data-iconname="fa fa-upload mr" class="form-control filestyle">
											</div>
											<div class="form-group">
												<label for="first_name">First Name</label>
												<input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter your First Name" required>
											</div>
											<div class="form-group">
												<label for="middle_name">Middle Name</label>
												<input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter your Middle Name" required>
											</div>
											<div class="form-group">
												<label for="last_name">Last Name</label>
												<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter your Last Name" required>
											</div>
											<div class="form-group">
												<label for="gender">Gender</label>
												<select name="gender" class="form-control" id="gender" required>
													<option value="">Select One</option>
													<option value="1">Male</option>
													<option value="2">Female</option>
												</select>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-sm btn-info">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="account">
								<div class="panel b">
									<div class="panel-heading bg-gray-lighter text-bold">
										Account
									</div>
									<div class="panel-body">
										<form class="accountForm" id="accountForm">
											<div class="form-group">
												<label for="current_password">Current Password</label>
												<input type="password" id="current_password" name="current_password" class="form-control" placeholder="Your current password" pattern=".{5,}" title="5 characters minimum" required>
											</div>
											<div class="form-group">
												<label for="new_password">New Password</label>
												<input type="password" id="new_password" name="new_password" class="form-control" placeholder="Your new password" pattern=".{5,}" title="5 characters minimum" required>
											</div>
											<div class="form-group">
												<label for="confirm_password">Confirm New Password</label>
												<input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-info">Update password</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="contact">
								<div class="panel b">
									<div class="panel-heading bg-gray-lighter text-bold clearfix">
										<span class="pull-left">Contact Details</span>
										<span class="pull-right"><a href="#" class="add_contact"><i class="fa fa-phone-square"></i> Add Contact Details</a></span>
									</div>
									<div class="panel-body">
										<form id="contactForm">
											<div class="row">
												<div class="contact_holder">
													<!-- <div class="contact">
														<div class="col-sm-3">
															<div class="form-group">
																<label for="contact_type">Contact Type</label>
																<select class="form-control contact_type" id="contact_type">
																	<option value="">Select One</option>
																</select>
															</div>		
														</div>
														<div class="col-sm-3">
															<div class="form-group">
																<label for="contact_prefix">Contact Number</label>
																<select class="form-control contact_prefix" id="contact_prefix">
																	<option value="">Select One</option>
																</select>
															</div>
														</div>
														<div class="col-sm-5 text-right">
															<label></label>
															<input type="text" name="number" class="form-control">
														</div>
														<div class="col-sm-1 text-right">
															<label>&nbsp;</label>
															<p><a href="#" class="btn btn-danger btn-xs" title="Delete Contact"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a></p>
														</div>
													</div> -->
												</div>
												<div class="col-sm-12">
													<div class="form-group">
														<button type="submit" class="btn btn-info">Update Phone Number</button>
													</div>
												</div>
											</div>
											
										</form>
									</div>
								</div>
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
	<!-- RTL demo-->
	<script src="/assets/js/demo-rtl.js"></script>
	<!-- =============== PAGE VENDOR SCRIPTS ===============-->
	<!-- SWEET ALERT-->
	<script src="/assets/js/sweetalert.min.js"></script>
	<script src="/assets/js/bootstrap-filestyle.js"></script>
	<!-- =============== APP SCRIPTS ===============-->
	<script src="/assets/js/app.js"></script>
	<script src="/app/model/user/js/user_details.js"></script>
	<script src="/assets/js/nav_active.js"></script>
	<script src="/app/model/user/js/logout.js"></script>
	<script src="/app/model/user/js/edit_profile.js"></script>
</body>
</html>