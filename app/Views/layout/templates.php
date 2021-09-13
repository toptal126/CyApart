<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="Simple Starter Project CodeIgniter 4" />
	<meta name="author" content="Ilham Lutfi (https://ilhamlutfi.my.id)" />
	<title><?= $title; ?></title>
	<link href="<?= base_url(); ?>/css/styles.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>


	<?= $this->renderSection('styles'); ?>
</head>

<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<a class="navbar-brand" href="<?= base_url('dashboard'); ?>">CyApart</a>
		<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
		<ul class="navbar-nav d-md-inline-block  ml-auto mr-0 my-2 ">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#profileModal" data-toggle="modal" data-target="#profileModal">Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
				</div>
			</li>
		</ul>
	</nav>
	<!-- Include sidebar -->
	<?= $this->include('layout/sidebar'); ?>

	<!-- Render section content -->
	<?= $this->renderSection('content'); ?>

	<!-- Footer -->
	<footer class="py-4 bg-light mt-auto">
		<div class="container-fluid">
			CyApart Written By Top Talent 126
		</div>
	</footer>
	</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>/js/scripts.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>/assets/demo/chart-area-demo.js"></script>
	<script src="<?= base_url(); ?>/assets/demo/chart-bar-demo.js"></script> -->
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>/assets/demo/datatables-demo.js"></script>

	<!-- Modal Logout -->
	<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Logout Confirm</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure..?, Please click the 'logout button'...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
					<a href="<?= base_url('/logout'); ?>" class="btn btn-primary btn-sm">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Profile -->
	<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user"></i> Your Profile</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Email : <?= session('user')->email ?> <br>
					Username : <?= session('user')->username; ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>