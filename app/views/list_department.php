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
	<!-- Loaders.css-->
	<link rel="stylesheet" href="/assets/css/loaders.css">
	<!-- =============== PAGE VENDOR STYLES ===============-->
	<!-- SWEET ALERT-->
	<link rel="stylesheet" href="/assets/css/sweetalert.css">
	<!-- =============== BOOTSTRAP STYLES ===============-->
	<link rel="stylesheet" href="/assets/css/bootstrap.css" id="bscss">
	<!-- =============== APP STYLES ===============-->
	<link rel="stylesheet" href="/assets/css/app.css" id="maincss"
></head>
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
												</select>
											</div>
										</form>	
									</div>
									<div class="col-sm-8">
										<form role="form" class="form-inline pull-right">
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
								<!-- <tr>
									<td>2</td>
									<td>Web Integration</td>
									<td>10</td>
									<td>
										<button type="button" class="btn btn-xs btn-info btn-outline">Update</button>
									</td>
								</tr> -->
							</tbody>
							<tfoot>
								<tr class="tfoot">
									<td colspan="2" class="num_result"></td>
									<td colspan="2" style="text-align:right">
										<nav>
											<ul id="paginate" class="pagination pagination-sm m0">
												<li class="previous" style="display: none;"">
													<a href="#" aria-label="Previous">
														<span aria-hidden="true">«</span>
													</a>
												</li>
												<li class="next" style="display: none;"">
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
				
			</div>
		</section>

		<!-- Page footer-->
		<?php include '../controller/includes/footer.php'; ?>

	</div>
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Update Department</h4>
				</div>
				<div class="modal-body">
					<form class="update_department" autocomplete="off">
					<input type="hidden" value="" id="dep_id" name="dep_id">
						<div class="form-group department_holder">
							<label for="dep_name">Department Name</label>
							<input type="text" name="dep_name" id="dep_name" class="form-control" value="">
						</div>
						<div class="form-group">
							<button class="btn btn-sm btn-info">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-content">
				<div class="sa-icon sa-success animate" style="display: block;">
					<span class="sa-line sa-tip animateSuccessTip"></span>
					<span class="sa-line sa-long animateSuccessLong"></span>
					<div class="sa-placeholder"></div>
					<div class="sa-fix"></div>
				</div>
			</div>
			</div>
		</div>
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
	<!-- =============== APP SCRIPTS ===============-->
	<script src="/assets/js/app.js"></script>
	<script src="/app/model/user/js/user_details.js"></script>
	<script src="/assets/js/nav_active.js"></script>
	<script src="/app/model/user/js/logout.js"></script>
	<script src="/app/model/user/js/view_department.js"></script>
</body>
</html>