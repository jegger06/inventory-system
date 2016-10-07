<?php
	
	session_start();
	if (empty($_SESSION['user_id'])) {
		header('Location: login');
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
				<h3>Tables
					<small>A showcase of different components inside tables</small>
				</h3>
				<!-- START panel-->
				<div class="panel panel-default">
					<div class="panel-heading">Demo Table #1</div>
					<!-- START table-responsive-->
					<div class="table-responsive">
						<table id="table-ext-1" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Department</th>
									<th>Position</th>
									<th>Profile</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Larry</td>
									<td>the Bird</td>
									<td>jegger.saren@transcosmos.com.ph</td>
									<td>Web Integration</td>
									<td>Associate</td>
									<td>1 week</td>
									<td>
										<label class="switch switch-sm">
											<input type="checkbox" checked="checked">
											<span></span>
										</label>
									</td>
								</tr>
								<tr>
									<td>Mark</td>
									<td>Otto</td>
									<td>mail@example.com</td>
									<td>Ecommerce</td>
									<td>Senior Associate</td>
									<td>25 minutes</td>
									<td>
										<label class="switch switch-sm">
											<input type="checkbox" checked="checked">
											<span></span>
										</label>
									</td>
								</tr>
								<tr>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>mail@example.com</td>
									<td>Panasonic</td>
									<td>Team Lead</td>
									<td>10 hours</td>
									<td>
										<label class="switch switch-sm">
											<input type="checkbox" checked="checked">
											<span></span>
										</label>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- END table-responsive-->
					<div class="panel-footer">
						<div class="row">
							<div class="col-lg-2">
								<div class="input-group">
									<input type="text" placeholder="Search" class="input-sm form-control">
									<span class="input-group-btn">
										<button type="button" class="btn btn-sm btn-default">Search</button>
									</span>
								</div>
							</div>
							<div class="col-lg-8"></div>
							<div class="col-lg-2">
								<div class="input-group pull-right">
									<select class="input-sm form-control">
										<option value="0">Bulk action</option>
										<option value="1">Delete</option>
										<option value="2">Clone</option>
										<option value="3">Export</option>
									</select>
									<span class="input-group-btn">
										<button class="btn btn-sm btn-default">Apply</button>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END panel-->
			</div>
		</section>
		<!-- Page footer-->
		<footer>
			<span>&copy; 2016 - Angle</span>
		</footer>
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
	<script src="/assets/js/jquery.localize.js"></script>
	<!-- RTL demo-->
	<script src="/assets/js/demo-rtl.js"></script>
	<!-- =============== PAGE VENDOR SCRIPTS ===============-->
	<!-- SPARKLINE-->
	<script src="/assets/js/index.js"></script>
	<!-- =============== APP SCRIPTS ===============-->
	<script src="/assets/js/app.js"></script>
	<script src="/assets/js/simply-toast.min.js"></script>
	<script src="/app/model/user/js/logout.js"></script>
</body>
</html>