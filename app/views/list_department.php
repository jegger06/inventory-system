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
					<small></small>
				</h3>
				<div class="panel panel-default">
					<div class="panel-heading">Demo Table #1</div>
					<!-- START table-responsive-->
					<div class="table-responsive">
						<table id="table-ext" class="table table-striped list_department">
							<thead>
								<tr>
									<th>#</th>
									<th>Department Name</th>
									<th>Number of Users</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2</td>
									<td>Web Integration</td>
									<td>10</td>
									<td>
										<button type="button" class="btn btn-xs btn-info btn-outline">Update</button>
										<button type="button" class="btn btn-xs btn-danger btn-outline">Delete</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- END table-responsive-->
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
	<!-- =============== APP SCRIPTS ===============-->
	<script src="/assets/js/app.js"></script>
	<script src="/assets/js/simply-toast.min.js"></script>
	<script src="/app/model/user/js/logout.js"></script>
</body>
</html>