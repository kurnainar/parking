<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('EmployeeVch_model');

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

	public function check_quota()
	{
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		$emp_id = $this->log_id;

		$check = $this->sitemodel->view('vw_emp', 'quota', ['emp_id'=>$emp_id]);
		$list_kendaraan = $this->sitemodel->custom_query('SELECT JenisKendaraan FROM vw_kendaraan_karyawan WHERE IdPengguna = '.$this->log_user.' ');

		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		$this->response['msg_2'] = $list_kendaraan;
		echo json_encode($this->response);
		exit;
	}

	public function view_vehicle()
	{
		$a = 1;
		$data = array();
		$res = $this->EmployeeVch_model->get_view($this->log_user);
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$col[] = $a;
			$col[] = $row->JenisKendaraan;
			$col[] = $row->NoKendaraan;
			$col[] = '<button class="btn btn-sm btn-warning btn-edit" title="Edit" data-id="'.$row->GroupKendaraanId.'>"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button class="btn btn-sm btn-danger btn-delete" title="Delete" data-id="'.$row->GroupKendaraanId.'>" data-name="'.$row->NoKendaraan.'"><i class="fas fa-trash"></i></button>';
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->EmployeeVch_model->get_view_count_all($this->log_user),
			"recordsFiltered" 	=> $this->EmployeeVch_model->get_view_count_filtered($this->log_user),
			"data" 				=> $data,
			"q"					=> $temp //temp for tracing db query

		);
		echo json_encode($output);
		exit;
	}

	public function find(){
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		/*** Params ***/
		/*** Required Area ***/
		$key = $this->input->post("key");
		/*** Optional Area ***/
		/*** Validate Area ***/
		if ( empty($key) ){$this->response['msg'] = "Invalid parameter.";echo json_encode($this->response);exit;}
		/*** Accessing DB Area ***/
		$check = $this->EmployeeVch_model->find($key);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}

	public function save()
	{
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		// PARAMS
		$KendaraanId	= $this->input->post('KendaraanId');
		$JenisPengguna	= 0;
		$IdPengguna		= $this->log_user;
		$NoKendaraan	= $this->input->post('NoKendaraan');
		$type 			= $this->input->post('type');
		$id 			= $this->input->post('id');

		$type = ($type == 'update') ? 'update' : 'new';

		$data = [
			'KendaraanId'	=> $KendaraanId,
			'JenisPengguna' => $JenisPengguna,
			'IdPengguna'	=> $IdPengguna,
			'NoKendaraan'	=> $NoKendaraan,
			'modified_date'	=> date('Y-m-d H:i:s'),
			'modified_id'	=> $this->log_id, 
		];

		if ($type == 'new') {
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_id'] = $this->log_id;
		}

		if ($type == 'update') {
			$this->sitemodel->update("tab_group_kendaraan", $data, ["GroupKendaraanId"=>$id]);
		}else{
			$result = $this->sitemodel->insert("tab_group_kendaraan", $data);

			$check = $this->sitemodel->view('vw_emp', '*', ['emp_id'=>$this->log_id]);

			foreach ($check as $row) {
				$data_quota = [
					'quota' => $row->quota - 1,
				];

				$this->sitemodel->update('tab_emp', $data_quota, ['emp_id'=>$this->log_id]);
			}
		}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = ($type == "update") ? "Successfully modified data." : "Successfully add data.";
		echo json_encode($this->response);
		exit;
	}

	public function delete(){
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		/*** Params ***/
		/*** Required Area ***/
		$key = $this->input->post("key");
		/*** Optional Area ***/
		/*** Validate Area ***/
		if ( empty($key) ){$this->response['msg'] = "Invalid parameter.";echo json_encode($this->response);exit;}
		/*** Accessing DB Area ***/
		$check = $this->EmployeeVch_model->find($key);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		// Delete 
		$this->sitemodel->delete("tab_group_kendaraan", ["GroupKendaraanId"=>$key]);

		$check = $this->sitemodel->view('vw_emp', '*', ['emp_id'=>$this->log_id]);

		foreach ($check as $row) {
			$data_quota = [
				'quota' => $row->quota + 1,
			];

			$this->sitemodel->update('tab_emp', $data_quota, ['emp_id'=>$this->log_id]);
		}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully remove data.";
		echo json_encode($this->response);
		exit;
	}
}