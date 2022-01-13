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

<!-- Bootstrap core JavaScript-->
<script type="text/javascript">var base_url = '<?php echo base_url(); ?>' </script>
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

<script>
	var t = setInterval(function () {
		var showTime = moment().format('dddd, DD MMMM YYYY HH:mm:ss');
		$('#timeCont').text(showTime);
	}, 1000);
</script>

<!-- Page level plugins -->
<!-- <script src="sbadmin/vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="sbadmin/js/demo/chart-area-demo.js"></script>
	<script src="sbadmin/js/demo/chart-pie-demo.js"></script> -->

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