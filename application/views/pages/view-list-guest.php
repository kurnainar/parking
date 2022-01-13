<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<h1 class="h3 mb-2 text-gray-800">Daftar Kendaraan Tamu</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<button type="button" class="btn btn-sm btn-primary btn-l2Form"><i class="fas fa-plus"> Tambah Data</i></button>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="listguestTbl" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Jenis Kendaraan</th>
							<th>No Polisi</th>
							<th><i class="fas fa-cogs"></i></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>

	<div id="listguest-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form method="POST" id="listguest-form" accept-charset="UTF-8">
					<div class="modal-header">
						<h4 class="modal-title strong"><span id="modal-type">Tambah Data</span></h4>
						<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row clearfix">
							<div class="form-group col-md-12">
								<label>ID Pengguna<span class="text-red">*</span></label>
								<select id="sUser_id" class="form-control" name="sUser_id">
									<option selected="" value="">-</option>
									<?php 
									if (isset($data_sUser) and $data_sUser != 0) {
										foreach ($data_sUser as $row) {
											?>
											<option value="<?= $row->sUser_id ?>"><?= $row->sUser_name ?></option>
											<?php 
										}
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label>Nama<span class="text-red">*</span></label>
								<input type="text" class="form-control" id="guest_name" maxlength="100" name="guest_name" value="" placeholder="..." required>
							</div>
							<div class="form-group col-md-12">
								<label>Keterangan<span class="text-red">*</span></label>
								<input type="text" class="form-control" id="guest_desc" maxlength="100" name="guest_desc" value="" placeholder="..." required>
							</div>
							<div class="form-group col-md-12">
								<label>Kendaraan<span class="text-red">*</span></label>
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
								<label>No Polisi<span class="text-red">*</span></label>
								<input type="text" class="form-control" id="NoKendaraan" maxlength="100" name="NoKendaraan" value="" placeholder="..." required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="text" class="collapse" id="type" name="type" value="">
						<input type="text" class="collapse" id="id" name="id" value="">
						<input type="text" class="collapse" id="id2" name="id2" value="">
						<button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
<!-- End of Main Content -->