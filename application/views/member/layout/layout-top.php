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
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-text mx-3">PARKING SYSTEM</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="<?= base_url(MEMBER_AUTH.'/vehicle'); ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Vehicle</span></a>
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

						<!-- Sidebar Toggle (Topbar) -->
						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
              	<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              		<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $log_name ?></span>
              	</a>
              	<!-- Dropdown - User Information -->
              	<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              		<a class="dropdown-item" href="#" data-toggle="modal" data-target="#cPass-modal">
              			<i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
              			Change Password
              		</a>
              		<div class="dropdown-divider"></div>
              		<a class="dropdown-item" href="<?= base_url(MEMBER_AUTH.'/site/signout'); ?>">
              			<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              			Logout
              		</a>
              	</div>
              </li>
            </ul>
          </nav>
      <!-- End of Topbar -->