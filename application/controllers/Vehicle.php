<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Vehicle_model');
		$this->load->model('Listemployee_model');
		$this->load->model('Listguest_model');
	}

	public function index()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}
		$this->fragment['js'] = base_url('assets/js/pages/vehicle.js');
		$this->fragment['pagename'] = 'pages/view-vehicle.php';
		$this->load->view('layout/main-site', $this->fragment);
	}

	public function list_employee()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}
		$this->fragment['data_emp'] = $this->sitemodel->view('vw_emp', '*');
		$this->fragment['data_kendaraan'] = $this->sitemodel->view('vw_kendaraan', '*');

		$this->fragment['js'] = base_url('assets/js/pages/list_employee.js');
		$this->fragment['pagename'] = 'pages/view-list-employee.php';
		$this->load->view('layout/main-site', $this->fragment);
	}

	public function list_guest()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}

		$this->fragment['data_kendaraan'] = $this->sitemodel->view('vw_kendaraan', '*');
		$this->fragment['data_sUser']	= $this->sitemodel->view('vw_special_user', '*');

		$this->fragment['js'] = base_url('assets/js/pages/list_guest.js');
		$this->fragment['pagename'] = 'pages/view-list-guest.php';
		$this->load->view('layout/main-site', $this->fragment);
	}

	public function view_vehicle()
	{
		$a = 1;
		$data = array();
		$res = $this->Vehicle_model->get_view();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$col[] = $a;
			$col[] = $row->JenisKendaraan;
			$col[] = '<button class="btn btn-sm btn-warning btn-edit" title="Edit" data-id="'.$row->KendaraanId.'>"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button class="btn btn-sm btn-danger btn-delete" title="Delete" data-id="'.$row->KendaraanId.'>" data-name="'.$row->JenisKendaraan.'"><i class="fas fa-trash"></i></button>';
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Vehicle_model->get_view_count_all(),
			"recordsFiltered" 	=> $this->Vehicle_model->get_view_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp //temp for tracing db query

		);
		echo json_encode($output);
		exit;
	}

	public function view_emp_vehicle()
	{
		$a = 1;
		$data = array();
		$res = $this->Listemployee_model->get_view();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$col[] = $a;
			$col[] = $row->IdPengguna;
			$col[] = $row->emp_name;
			$col[] = $row->JenisKendaraan;
			$col[] = $row->NoKendaraan;
			$col[] = '<button class="btn btn-sm btn-warning btn-edit" title="Edit" data-id="'.$row->GroupKendaraanId.'>"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button class="btn btn-sm btn-danger btn-delete" title="Delete" data-id="'.$row->GroupKendaraanId.'>" data-name="'.$row->NoKendaraan.'"><i class="fas fa-trash"></i></button>';
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Listemployee_model->get_view_count_all(),
			"recordsFiltered" 	=> $this->Listemployee_model->get_view_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp //temp for tracing db query

		);
		echo json_encode($output);
		exit;
	}

	public function view_guest_vehicle()
	{
		$a = 1;
		$data = array();
		$res = $this->Listguest_model->get_view();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$col[] = $a;
			$col[] = $row->guest_name;
			$col[] = $row->JenisKendaraan;
			$col[] = $row->NoKendaraan;
			$col[] = '<button class="btn btn-sm btn-warning btn-edit" title="Edit" data-id="'.$row->GroupKendaraanId.'>"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button class="btn btn-sm btn-danger btn-delete" title="Delete" data-id="'.$row->GroupKendaraanId.'>" data-name="'.$row->NoKendaraan.'"><i class="fas fa-trash"></i></button>';
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Listguest_model->get_view_count_all(),
			"recordsFiltered" 	=> $this->Listguest_model->get_view_count_filtered(),
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
		$check = $this->Vehicle_model->find($key);
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}

	public function find_emp_vehicle(){
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
		$check = $this->Listemployee_model->find($key);
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}

	public function find_guest_vehicle(){
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
		$check = $this->Listguest_model->find($key);
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
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
		$JenisKendaraan	= $this->input->post('JenisKendaraan');
		$type 			= $this->input->post('type');
		$id 			= $this->input->post('id');

		$type = ($type == 'update') ? 'update' : 'new';

		$data = [
			'JenisKendaraan'	=> $JenisKendaraan,
			'modified_date'		=> date('Y-m-d H:i:s'),
			'modified_id'		=> $this->log_id, 
		];

		if ($type == 'new') {
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_id'] = $this->log_id;
		}

		if ($type == 'update') {
			$this->sitemodel->update("tab_kendaraan", $data, ["KendaraanId"=>$id]);
		}else{
			$result = $this->sitemodel->insert("tab_kendaraan", $data);
		}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = ($type == "update") ? "Berhasil mengubah data." : "Berhasil menambahkan data.";
		echo json_encode($this->response);
		exit;

	}

	public function save_emp_vehicle()
	{
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		// PARAMS
		$KendaraanId	= $this->input->post('KendaraanId');
		$JenisPengguna	= 0;
		$IdPengguna		= $this->input->post('IdPengguna');
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
		}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = ($type == "update") ? "Berhasil mengubah data." : "Berhasil menambahkan data.";
		echo json_encode($this->response);
		exit;

	}

	public function save_guest_vehicle()
	{
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		// PARAMS
		$sUser_id		= $this->input->post('sUser_id');
		$guest_name		= $this->input->post('guest_name');
		$guest_desc		= $this->input->post('guest_desc');

		$KendaraanId	= $this->input->post('KendaraanId');
		$JenisPengguna	= 1;
		$NoKendaraan	= $this->input->post('NoKendaraan');
		$type 			= $this->input->post('type');
		$id 			= $this->input->post('id');
		$id2 			= $this->input->post('id2');

		$type = ($type == 'update') ? 'update' : 'new';

		$data_guest = [
			'sUser_id'		=> $sUser_id,
			'guest_name' 	=> $guest_name,
			'guest_desc'	=> $guest_desc,
			'modified_date'	=> date('Y-m-d H:i:s'),
			'modified_id'	=> $this->log_id, 
		];

		$data_guest_vehicle = [
			'KendaraanId'	=> $KendaraanId,
			'JenisPengguna' => $JenisPengguna,
			'NoKendaraan'	=> $NoKendaraan,
			'modified_date'	=> date('Y-m-d H:i:s'),
			'modified_id'	=> $this->log_id, 
		];

		if ($type == 'new') {
			$data_guest['created_date'] 		= date('Y-m-d H:i:s');
			$data_guest['created_id'] 			= $this->log_id;
			$data_guest_vehicle['created_date'] = date('Y-m-d H:i:s');
			$data_guest_vehicle['created_id'] 	= $this->log_id;
		}

		if ($type == 'new') {
			$guest_id = $this->sitemodel->insert('tab_guest', $data_guest);
			$data_guest_vehicle['IdPengguna'] = $guest_id;
			$result = $this->sitemodel->insert("tab_group_kendaraan", $data_guest_vehicle);
		}else{
			$this->sitemodel->update('tab_guest', $data_guest, ['guest_id'=>$id2]);
			$this->sitemodel->update('tab_group_kendaraan', $data_guest_vehicle, ['GroupKendaraanId'=>$id]);
		}

		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = ($type == "update") ? "Berhasil mengubah data." : "Berhasil menambahkan data.";
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
		$check = $this->Vehicle_model->find($key);
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
		// Delete 
		$this->sitemodel->delete("tab_kendaraan", ["KendaraanId"=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Berhasil menghapus data.";
		echo json_encode($this->response);
		exit;
	}

	public function delete_emp_vehicle(){
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
		$check = $this->Listemployee_model->find($key);
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
		// Delete 
		$this->sitemodel->delete("tab_group_kendaraan", ["GroupKendaraanId"=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Berhasil menghapus data.";
		echo json_encode($this->response);
		exit;
	}

	public function delete_guest_vehicle(){
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
		$check = $this->Listguest_model->find($key);
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
		// Delete 
		$this->sitemodel->delete("tab_group_kendaraan", ["GroupKendaraanId"=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Berhasil menghapus data.";
		echo json_encode($this->response);
		exit;
	}
}