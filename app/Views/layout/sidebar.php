<div id="layoutSidenav">
	<div id="layoutSidenav_nav">
		<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
			<div class="sb-sidenav-menu">
				<div class="nav">
					<div class="sb-sidenav-menu-heading">Core</div>
					<a class="nav-link" href="<?= base_url('dashboard'); ?>">
						<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
						Dashboard
					</a>
					<div class="sb-sidenav-menu-heading">System Settings</div>
					<a class="nav-link" href="<?= base_url('perspective'); ?>">
						<div class="sb-nav-link-icon"><i class="fas fa-image"></i></div>
						Perspective
					</a>
					<a class="nav-link" href="<?= base_url('apartments'); ?>">
						<div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
						Apartments
					</a>
					<a class="nav-link" href="<?= base_url('preview'); ?>">
						<div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
						Preview
					</a>
					<a hidden class="nav-link" href="<?= base_url('objects'); ?>">
						<div class="sb-nav-link-icon"><i class="fas fa-server"></i></div>
						Object Model
					</a>
					<a hidden class="nav-link" href="<?= base_url('ajax-jquery'); ?>">
						<div class="sb-nav-link-icon"><i class="fas fa-spinner"></i></div>
						Ajax jQuery
					</a>
					<div class="sb-sidenav-menu-heading">Logout</div>
					<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
						<div class="sb-nav-link-icon"><i class="fas fa-power-off"></i></div>
						Logout
					</a>
				</div>
			</div>
			<div class="sb-sidenav-footer">
				<div class="small">Welcome: <?= session("user")->username ?></div>
				
			</div>
		</nav>
	</div>