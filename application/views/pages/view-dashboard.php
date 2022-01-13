<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Parking</h1>
	</div>

    <form id="frmTapIn">
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">CLOCK</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div id="timeCont"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1"></div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800">NO. KENDARAAN</div>
                                <input type="text" class="form-control" name="plat_no" id="plat_no" placeholder="No. Kendaraan" autofocus="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1"></div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800">ID CARD</div>
                                <input type="text" class="form-control" name="id_card" id="id_card" placeholder="ID Number">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">SLOT PARKIR MOBIL</div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800" id="carSlot">XX</div>
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">SLOT PARKIR MOTOR</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="bikeSlot">XX</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </form>

	<div class="row">

		<!-- Area Chart -->
		<div class="col-xl-8 col-lg-7">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">PARKIR MASUK</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-area">
						<div class="chart-pie">
							<div class="card-body">
								<p class="card-text">Nomor Kendaraan : <span id="plat_no"></span></p>
								<p class="card-text">NIP Karyawan : <span id="emp_nip"></span></p>
								<p class="card-text">Nama Karyawan : <span id="emp_name"></span></p>
								<p class="card-text">Perusahaan/ Departemen : <span id=""></span></p>
								<p class="card-text">Keterangan : <span id=""></span></p> 
								<p class="card-text">Waktu Masuk : <span id="TAKEN_DATE"></span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pie Chart -->
		<div class="col-xl-4 col-lg-5">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Daftar Parkir</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-pie pt-4 pb-2">
						<table id="historyTbl" class="table table-striped table-hovered" style="font-size: 11pt;">
							<thead>
								<th ></th>
								<th>Waktu Masuk</th>
								<th>Nomor Kendaraan</th>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of Main Content -->