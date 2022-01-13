<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Parking System Media Group</title>

	<!-- Custom fonts for this template-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sbadmin/vendor/fontawesome-free/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sbadmin/css/sb-admin-2.min.css">
	<link href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
				<div class="sidebar-brand-text mx-3">PARKING SYSTEM</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>">
                    <i class="fas fa-road"></i>
                    <span>Parking</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Site/keluar'); ?>">
                    <i class="fas fa-minus-circle"></i>
                    <span>Exit</span>
                </a>
            </li>

				<!-- Divider -->
				<hr class="sidebar-divider">

				<!-- Heading -->
				<div class="sidebar-heading">
					Admin
				</div>

				<?php
				if (isset($menu_header) and $menu_header != 0) {
					foreach ($menu_header as $row) {
						?>
						<li class="nav-item <?= ($header_menu == $row->nav_name ? 'active' : '') ?>">
							<a class="nav-link <?= ($header_menu == $row->nav_name ? '' : 'collapsed') ?>" href="#" data-toggle="collapse" data-target="#id_<?= $row->nav_id ?>" aria-expanded="true" aria-controls="collapseTwo">
								<i class="fas fa-fw fa-folder"></i>
								<span><?= $row->nav_name ?></span>
							</a>
							<div id="id_<?= $row->nav_id ?>" class="collapse <?= ($header_menu == $row->nav_name ? 'show' : '') ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
								<div class="bg-white py-2 collapse-inner rounded">
									<?php
									if (isset($menu_child) and $menu_child != 0) {
										foreach ($menu_child as $row2) {
											if ($row2->nav_parent == $row->nav_id) {
												?>
												<a class="collapse-item <?= ($child_menu == $row2->nav_name ? 'active' : '') ?>" href="<?= base_url($row2->nav_ctr) ?>"><?= $row2->nav_name ?></a>
												<?php 
											}
										}
									} 
									?>
								</div>
							</div>
						</li>
						<?php 
					}
				} 
				?>

				<!-- Nav Item - Utilities Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#">
						<i class="fas fa-download fa-sm"></i>
						<span>Laporan</span>
					</a>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">

				<!-- Sidebar Toggler (Sidebar) -->
				<div class="text-center d-none d-md-inline">
					<button class="rounded-circle border-0" id="sidebarToggle"></button>
				</div>

			</ul>
			<!-- End of Sidebar -->

			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">

				<!-- Main Content -->
				<div id="content">

					<!-- Topbar -->
					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

						<!-- Sidebar - Brand -->
						<a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
							<div class="sidebar-brand-text mx-3"><?= $log_name ?></div>
						</a>

						<!-- Sidebar Toggle (Topbar) -->
						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>

						<!-- Topbar Navbar -->
						<ul class="navbar-nav ml-auto">

							<div class="topbar-divider d-none d-sm-block"></div>

							<!-- Nav Item - User Information -->
							<li class="nav-item dropdown no-arrow">
								<a class="dropdown-item" href="<?= base_url('site/signout'); ?>">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</li>

						</ul>

					</nav>
      <!-- End of Topbar -->