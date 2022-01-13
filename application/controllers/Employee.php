<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}

		$this->fragment['data_kendaraan'] = $this->sitemodel->view('vw_kendaraan', '*');
		$this->fragment['js'] = base_url('assets/js/pages/employee.js');
		$this->fragment['pagename'] = 'pages/view-employee.php';
		$this->load->view('layout/main-site', $this->fragment);
	}

	public function check_quota()
	{
		echo json_encode(1);
	}
}