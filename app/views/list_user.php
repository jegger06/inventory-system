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
	<!-- Loaders.css-->
	<link rel="stylesheet" href="/assets/css/loaders.css">
	<!-- =============== PAGE VENDOR STYLES ===============-->
	<!-- SWEET ALERT-->
	<link rel="stylesheet" href="/assets/css/sweetalert.css">
	<!-- =============== BOOTSTRAP STYLES ===============-->
	<link rel="stylesheet" href="/assets/css/bootstrap.css" id="bscss">
	<!-- =============== APP STYLES ===============-->
	<link rel="stylesheet" href="/assets/css/app.css">
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
				<h3>Users Record
					<!-- <small>A showcase of different components inside tables</small> -->
				</h3>
				
				<!-- START panel-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-4">
										<form class="form-inline">
											<div class="form-group">
												<label class="">Records per page</label>
												<select name="per_page" id="per_page" class="form-control input">
													<option value="5">5</option>
													<option value="10">10</option>
													<option value="15">15</option>
													<option value="20">20</option>
													<option value="30">30</option>
												</select>
											</div>
										</form>	
									</div>
									<div class="col-sm-8">
										<form role="form" class="form-inline pull-right">

											<div class="form-group">
												<select name="department" id="department" class="form-control input" required>
													<option value="">All Department</option>
												</select>
											</div>
											<div class="form-group">
												<select name="position" id="position" class="form-control input" required>
													<option value="">All Position</option>
												</select>
											</div>
											<div class="form-group">
												<select name="status" id="status" class="form-control input" required>
													<option value="">All Status</option>
												</select>
											</div>
											<div class="form-group">
												<div class="input-group">
													<input type="text" id="search" placeholder="Search name" class="input-sm form-control input">
													<span class="input-group-btn">
													<button type="button" class="btn btn-sm btn-default">Search</button>
													</span>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				<!-- START table-responsive-->
						
					<div class="table-responsive">
						<div class="loader_holder"><div class="triangle-skew-spin"><div></div></div></div>
						<table id="table-ext-1" class="table table-striped list_user">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>User Name</th>
									<th>Email</th>
									<th>Department</th>
									<th>Position</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr class="tfoot">
									<td colspan="3" class="num_result"></td>
									<td colspan="4" align="right">
										<nav>
											<ul id="paginate" class="pagination pagination-sm m0">
												<li class="previous" style="display: none;">
													<a href="#" aria-label="Previous">
														<span aria-hidden="true">«</span>
													</a>
												</li>
												<li class="next" style="display: none;">
													<a href="#" aria-label="Next">
														<span aria-hidden="true">»</span>
													</a>
												</li>
											</ul>
										</nav>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- END table-responsive-->
					
				</div>
				<!-- END panel-->
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
	<!-- SWEET ALERT-->
	<script src="/assets/js/sweetalert.min.js"></script>
	<!-- SPARKLINE-->
	<script src="/assets/js/index.js"></script>
	<!-- =============== APP SCRIPTS ===============-->
	<script src="/assets/js/app.js"></script>
	<script src="/assets/js/nav_active.js"></script>
	<script src="/app/model/user/js/logout.js"></script>
	<script src="/app/model/user/js/view_user.js"></script>
</body>
</html>