<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<h1 class="h3 mb-2 text-gray-800"><?= $page_title ?></h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<button type="button" class="btn btn-sm btn-primary btn-emp-form" style="float: right;"><i class="fas fa-plus"> New Entry</i></button>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="listemployeeTbl" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>NIP</th>
							<th>Name</th>
							<th>Vehicle</th>
							<th>Plat Number</th>
							<th><i class="fas fa-cogs"></i></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>

	<div id="listemployee-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form method="POST" id="listemployee-form" accept-charset="UTF-8">
					<div class="modal-header">
						<h4 class="modal-title strong"><span id="modal-type">New Entry</span></h4>
						<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row clearfix">
							<div class="form-group col-md-12">
								<label>Employee Name<span class="text-red">*</span></label>
								<select id="IdPengguna" class="form-control" name="IdPengguna" style="width: 360px;">
									<option selected="" value="">-</option>
									<?php 
									if (isset($data_emp) and $data_emp != 0) {
										foreach ($data_emp as $row) {
											?>
											<option value="<?= $row->emp_nip ?>"><?= $row->emp_nip . ' - ' . $row->emp_name ?></option>
											<?php 
										}
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label>Vehicle<span class="text-red">*</span></label>
								<select class="form-control" id="KendaraanId" name="KendaraanId" required="">
									<option selected="" value="">-</option>
									<?php 
									if (isset($data_kendaraan) and $data_kendaraan != 0) {
										foreach ($data_kendaraan as $row2) {
											?>
											<option value="<?= $row2->KendaraanId ?>"><?= $row2->JenisKendaraan ?></option>
											<?php 
										}
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label>Plat Number<span class="text-red">*</span></label>
								<input type="text" class="form-control" id="NoKendaraan" maxlength="100" name="NoKendaraan" value="" placeholder="..." required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="text" class="collapse" id="type" name="type" value="">
						<input type="text" class="collapse" id="id" name="id" value="">
						<button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
<!-- End of Main Content -->