<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; MIS METRO TV 2020</span>
		</div>
	</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- CHANGE PASSWORD MODAL -->
<div id="cPass-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" id="cPass-form" accept-charset="UTF-8">
				<div class="modal-header">
					<h4 class="modal-title strong"><span id="modal-type">Change Password</span></h4>
					<button type="button" class="close text-red close-cPass-modal" data-dismiss="modal" tabindex="-1">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row clearfix">
						<div class="form-group col-md-12">
							<label>Old Password<span class="text-red">*</span></label>
							<div class="input-group">
								<input type="password" class="form-control" id="OldPassword" maxlength="100" name="OldPassword" value="" placeholder="..." required>
								<span class="input-group-addon"><i class="fa fa-eye text-blue click-to-view"></i></span>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label>New Password<span class="text-red">*</span></label>
							<div class="input-group">
								<input type="password" class="form-control" id="NewPassword" maxlength="100" name="NewPassword" value="" placeholder="..." required>
								<span class="input-group-addon"><i class="fa fa-eye text-blue click-to-view"></i></span>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label>Confirm Password<span class="text-red">*</span></label>
							<div class="input-group">
								<input type="password" class="form-control" id="ConfirmPassword" maxlength="100" name="ConfirmPassword" value="" placeholder="..." required>
								<span class="input-group-addon"><i class="fa fa-eye text-blue click-to-view"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btn-change" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Bootstrap core JavaScript-->
<script type="text/javascript">var base_url = '<?php echo base_url().MEMBER_AUTH; ?>' </script>
<script src="<?php echo base_url(); ?>assets/sbadmin/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url(); ?>assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url(); ?>assets/sbadmin/js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-form/jquery.form.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/member/main.js"></script>

<!-- Page Script -->
<?php 
if (isset($js)) {
	?>
	<script src="<?= $js ?>"></script>
	<?php 
}
?>

</body>
</html>