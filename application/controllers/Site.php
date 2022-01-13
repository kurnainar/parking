<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}
		$this->fragment['header_menu'] = 'Parking';
		$this->fragment['child_menu'] = '';
		$this->fragment['js'] = base_url('assets/js/pages/dashboard.js');
		$this->fragment['pagename'] = 'pages/view-dashboard.php';
		$this->load->view('layout/main-site', $this->fragment);
	}

    public function keluar()
    {
        if ( !$this->hasLogin() ) {
            redirect('site/login');
        }
        $this->fragment['header_menu'] = 'Exit';
        $this->fragment['child_menu'] = '';
        $this->fragment['js'] = base_url('assets/js/pages/exit.js');
        $this->fragment['pagename'] = 'pages/view-exit.php';
        $this->load->view('layout/main-site', $this->fragment);
    }

	public function login()
	{
		/*** Check Session ***/
		if( $this->hasLogin() ) redirect();
		$this->load->view('login_page');
	}

	public function signin()
	{
		/*** Check Session ***/
		if( $this->hasLogin() ) redirect();
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}

		$user_name = trim($this->input->post('user_name'));
		$user_pass = md5($this->input->post('user_pass'));

		if ( empty($user_name) ) {$this->response['type'] = "Failed";$this->response['msg'] = "Please input a valid username";echo json_encode($this->response);exit;}
		if ( empty($user_pass) ) {$this->response['type'] = "Failed";$this->response['msg'] = "Please input a valid password";echo json_encode($this->response);exit;}

		$res = $this->sitemodel->view('vw_user', '*', ['user_name'=>$user_name]);

		if ($res) {
			$pwd = '';
			$data_sess = array();

			foreach ($res as $row) {
				$data_sess['log_id'] = $row->user_id;
				$data_sess['log_user'] = $row->user_name;
				$data_sess['log_name'] = $row->user_fname;
				$pwd = $row->user_pass;
			}

			if ($user_pass !== $pwd) {
				$this->response['type'] = "Failed";
				$this->response['msg'] = "Wrong Password";
				echo json_encode($this->response);
				exit;
			}

			$this->session->set_userdata(SESS, (object)$data_sess);
			
			$this->response['type'] = 'done';
			$this->response['msg'] = "Successfully login.";
			echo json_encode($this->response);

		}else{
			$this->response['type'] = "Failed";
			$this->response['msg'] = "No Data Found";
			echo json_encode($this->response);
			exit;
		}
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect ( base_url("site/login") );
	}

	public function check_slot()
	{
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		$check = $this->sitemodel->view('vw_slot', '*');
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		foreach ($check as $row) {
			if ($row->JenisKendaraan == 'Mobil') {
				$this->response['carSlot'] = $row->sisa;
			}else{
				$this->response['bikeSlot'] = $row->sisa;
			}
		}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}
}