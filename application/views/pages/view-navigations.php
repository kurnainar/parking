<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<h1 class="h3 mb-2 text-gray-800"><?= $page_title ?></h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<button type="button" class="btn btn-sm btn-primary btn-nav-form" style="float: right;"><i class="fas fa-plus"> New Entry</i></button>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="navTbl" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Controller</th>
							<th>Parent</th>
							<th><i class="fas fa-cogs"></i></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>

	<div id="nav-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form method="POST" id="nav-form" accept-charset="UTF-8">
					<div class="modal-header">
						<h4 class="modal-title strong"><span id="modal-type">New Entry</span></h4>
						<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row clearfix">
							<div class="form-group col-md-6">
								<label>Name<span class="text-red">*</span></label>
								<input type="text" class="form-control" id="nav_name" maxlength="100" name="nav_name" value="" placeholder="..." required>
							</div>
							<div class="form-group col-md-6">
								<label>Controller<span class="text-red">*</span></label>
								<input type="text" class="form-control" id="nav_ctr" maxlength="100" name="nav_ctr" value="" placeholder="...">
							</div>
							<div class="form-group col-md-6">
								<label>Parent<span class="text-red">*</span></label>
								<select class="form-control" id="nav_parent" name="nav_parent" required="">
									<option value="0">Root</option>
									<?php 
									if (isset($parent) and $parent != 0) {
										foreach ($parent as $row) {
											?>
											<option value="<?= $row->nav_id ?>"><?= $row->nav_name ?></option>
											<?php 
										}
									}
									?>	
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Order<span class="text-red">*</span></label>
								<input type="number" class="form-control" id="nav_order" maxlength="100" name="nav_order" value="" placeholder="..." required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="text" class="collapse" id="type" name="type" value="">
						<input type="text" class="collapse" id="id" name="id" value="">
						<button type="submit" id="btn-submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End of Main Content -->