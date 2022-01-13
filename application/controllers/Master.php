<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Vehicle_model');
		$this->load->model('Listemployee_model');
		$this->load->model('Slot_model');
	}

	public function vehicle()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}
		$this->fragment['header_menu'] = 'Master';
		$this->fragment['child_menu'] = 'Vehicle';
		$this->fragment['page_title'] = 'Vehicle';
		$this->fragment['js'] = base_url('assets/js/pages/vehicle.js');
		$this->fragment['pagename'] = 'pages/view-vehicle.php';
		$this->load->view('layout/main-site', $this->fragment);
	}

	public function slot()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}
		$this->fragment['data_kendaraan'] = $this->sitemodel->view('vw_kendaraan', '*');
		$this->fragment['header_menu'] = 'Master';
		$this->fragment['child_menu'] = 'Slot Vehicle';
		$this->fragment['page_title'] = 'Slot Vehicle';
		$this->fragment['js'] = base_url('assets/js/pages/slot.js');
		$this->fragment['pagename'] = 'pages/view-slot.php';
		$this->load->view('layout/main-site', $this->fragment);
	}

	public function list_employee()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}
		$this->fragment['data_emp'] = $this->sitemodel->view('vw_emp', '*');
		$this->fragment['data_kendaraan'] = $this->sitemodel->view('vw_kendaraan', '*');

		$this->fragment['header_menu'] = 'Master';
		$this->fragment['child_menu'] = 'List Employee';
		$this->fragment['page_title'] = 'List Employee';
		$this->fragment['js'] = base_url('assets/js/pages/list_employee.js');
		$this->fragment['pagename'] = 'pages/view-list-employee.php';
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

	public function view_slot()
	{
		$a = 1;
		$data = array();
		$res = $this->Slot_model->get_view();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$col[] = $a;
			$col[] = $row->JenisKendaraan;
			$col[] = $row->slot_count;
			$col[] = '<button class="btn btn-sm btn-warning btn-edit" title="Edit" data-id="'.$row->slot_id.'>"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button class="btn btn-sm btn-danger btn-delete" title="Delete" data-id="'.$row->slot_id.'>" data-name="'.$row->JenisKendaraan.'"><i class="fas fa-trash"></i></button>';
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Slot_model->get_view_count_all(),
			"recordsFiltered" 	=> $this->Slot_model->get_view_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp //temp for tracing db query

		);
		echo json_encode($output);
		exit;
	}

	public function find_vehicle(){
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
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
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

	public function find_slot(){
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
		$check = $this->Slot_model->find($key);
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}

	public function save_vehicle()
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
		$this->response['msg'] = ($type == "update") ? "Successfully modified data." : "Successfully added data.";
		echo json_encode($this->response);
		exit;
	}

	public function save_slot()
	{
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		// PARAMS
		$KendaraanId	= $this->input->post('KendaraanId');
		$slot_count		= $this->input->post('slot_count');
		$type 			= $this->input->post('type');
		$id 			= $this->input->post('id');

		$type = ($type == 'update') ? 'update' : 'new';

		$data = [
			'KendaraanId'		=> $KendaraanId,
			'slot_count'		=> $slot_count,
			'modified_date'		=> date('Y-m-d H:i:s'),
			'modified_id'		=> $this->log_id, 
		];

		if ($type == 'new') {
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_id'] = $this->log_id;
		}

		if ($type == 'update') {
			$this->sitemodel->update("tab_slot_kendaraan", $data, ["slot_id"=>$id]);
		}else{
			$result = $this->sitemodel->insert("tab_slot_kendaraan", $data);
		}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = ($type == "update") ? "Successfully modified data." : "Successfully added data.";
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

	public function delete_vehicle(){
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
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		// Delete 
		$this->sitemodel->delete("tab_kendaraan", ["KendaraanId"=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully remove data.";
		echo json_encode($this->response);
		exit;
	}

	public function delete_slot(){
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
		$check = $this->Slot_model->find($key);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		// Delete 
		$this->sitemodel->delete("tab_slot_kendaraan", ["slot_id"=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully remove data.";
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
}
