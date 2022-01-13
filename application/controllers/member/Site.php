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
			redirect(MEMBER_AUTH.'/site/login');
		}
		$this->fragment['data_kendaraan'] = $this->sitemodel->custom_query('SELECT * FROM vw_kendaraan WHERE KendaraanId IN(1,2)');
		$this->fragment['js'] = base_url('assets/js/member/vehicle.js');
		$this->fragment['pagename'] = MEMBER_FILE.'pages/view-vehicle.php';
		$this->load->view(MEMBER_FILE.'layout/main-site', $this->fragment);
	}

	public function login()
	{
		/*** Check Session ***/
		if( $this->hasLogin() ) redirect();
		$this->load->view(MEMBER_FILE.'login_page');
	}

	public function signin()
	{
		/*** Check Session ***/
		if( $this->hasLogin() ) redirect();
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}

		$emp_nip = trim($this->input->post('emp_nip'));
		$emp_pass = md5($this->input->post('emp_pass'));

		if ( empty($emp_nip) ) {$this->response['type'] = "Failed";$this->response['msg'] = "Please input a valid username";echo json_encode($this->response);exit;}
		if ( empty($emp_pass) ) {$this->response['type'] = "Failed";$this->response['msg'] = "Please input a valid password";echo json_encode($this->response);exit;}

		$res = $this->sitemodel->view('vw_emp', '*', ['emp_nip'=>$emp_nip]);

		if ($res) {
			$pwd = '';
			$data_sess = array();

			foreach ($res as $row) {
				$data_sess['log_id'] = $row->emp_id;
				$data_sess['log_user'] = $row->emp_nip;
				$data_sess['log_name'] = $row->emp_name;
				$pwd = $row->emp_pass;
			}

			if ($emp_pass !== $pwd) {
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
		redirect(MEMBER_AUTH.'/site/login');
	}

	public function change_password()
	{
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){
			$this->response['msg'] = "Invalid parameters.";
			echo json_encode($this->response);
			exit;
		}
		/*** Params ***/
		/*** Required Area ***/
		$OldPassword 		= $this->input->post("OldPassword");
		$NewPassword 		= $this->input->post("NewPassword");
		$ConfirmPassword 	= $this->input->post("ConfirmPassword");
		/*** Optional Area ***/
		/*** Validate Area ***/
		if ( empty($OldPassword) ){$this->response['msg'] 		= "Input old password.";echo json_encode($this->response);exit;}
		if ( empty($NewPassword) ){$this->response['msg'] 		= "Input new password.";echo json_encode($this->response);exit;}
		if ( empty($ConfirmPassword) ){$this->response['msg'] 	= "Input confirmation password.";echo json_encode($this->response);exit;}
		if ( $ConfirmPassword != $NewPassword ){$this->response['msg'] = "Confirmation password must be same with new password.";echo json_encode($this->response);exit;}
		/*** Accessing DB Area ***/
		$check = $this->sitemodel->view('vw_emp', 'emp_pass', ['emp_id'=>$this->log_id]);
		if (!$check) {$this->response['msg'] = "Data not found.";echo json_encode($this->response);exit;}

		foreach ($check as $row) {
			if (md5($OldPassword) != $row->emp_pass) {
				$this->response['msg'] = "Old password not match.";
				echo json_encode($this->response);
				exit;
			}
		}

		$data = [
			'emp_pass' 	=> md5($NewPassword),
			'is_change'	=> 1
		];
		$this->sitemodel->update('tab_emp', $data, ['emp_id'=>$this->log_id]);

		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully change password.";
		echo json_encode($this->response);
		exit;
	}

	public function initiate_check()
	{
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, please refresh your browser.";echo json_encode($this->response);exit;}
		$emp_id = $this->log_id;
		$check = $this->sitemodel->view('vw_emp', '*', ['emp_id'=>$emp_id]);

		foreach ($check as $row) {
			$this->response['is_change'] = $row->is_change;
		}
		echo json_encode($this->response);
		exit;
	}
}