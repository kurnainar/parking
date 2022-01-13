<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developer extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Navigations_model');
	}

	public function navigations()
	{
		if ( !$this->hasLogin() ) {
			redirect('site/login');
		}
		$this->fragment['header_menu'] = 'Developer';
		$this->fragment['child_menu'] = 'Navigations';
		$this->fragment['page_title'] = 'Navigations';
		$this->fragment['parent']	= $this->sitemodel->view('vw_nav', 'nav_id, nav_name', array('nav_parent' => '0', 'nav_level' => '0') );
		$this->fragment['js'] = base_url('assets/js/pages/navigations.js');
		$this->fragment['pagename'] = 'pages/view-navigations.php';
		$this->load->view('layout/main-site', $this->fragment);
	}

	public function view_nav()
	{
		$a = 1;
		$data = array();
		$res = $this->Navigations_model->get_view();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$col[] = $a;
			$col[] = $row->nav_name;
			$col[] = ($row->nav_ctr == '') ? '-' : $row->nav_ctr;
			$col[] = ($row->parent_name == '') ? 'Root' : $row->parent_name;
			$col[] = '<button class="btn btn-sm btn-warning btn-edit" title="Edit" data-id="'.$row->nav_id.'>"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button class="btn btn-sm btn-danger btn-delete" title="Delete" data-id="'.$row->nav_id.'>" data-name="'.$row->nav_name.'"><i class="fas fa-trash"></i></button>';
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Navigations_model->get_view_count_all(),
			"recordsFiltered" 	=> $this->Navigations_model->get_view_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp //temp for tracing db query

		);
		echo json_encode($output);
		exit;
	}

	public function find_nav(){
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
		$check = $this->Navigations_model->find($key);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}

	public function save_nav()
	{
		$nav_id;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		// PARAMS
		$nav_name 	= $this->input->post('nav_name');
		$nav_ctr 	= $this->input->post('nav_ctr');
		$nav_parent = $this->input->post('nav_parent');
		$nav_order  = $this->input->post('nav_order');
		$type 		= $this->input->post('type');
		$id 		= $this->input->post('id');

		$type = ($type == 'update') ? 'update' : 'new';

		$data = [
			'nav_name' 		=> $nav_name,
			'nav_ctr'		=> $nav_ctr,
			'nav_parent'	=> $nav_parent,
			'nav_order'		=> $nav_order,
			'nav_level'		=> ($nav_parent == '0') ? '0' : '1',
			'modified_date'	=> date('Y-m-d H:i:s'),
			'modified_id'	=> $this->log_id, 
		];

		if ($type == 'new') {
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_id'] = $this->log_id;
		}

		if ($type == 'update') {
			$this->sitemodel->update("tab_nav", $data, ["nav_id"=>$id]);
		}else{
			$result = $this->sitemodel->insert("tab_nav", $data);
		}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = ($type == "update") ? "Successfully modified data." : "Successfully insert data.";
		echo json_encode($this->response);
		exit;

	}

	public function delete_nav(){
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
		$check = $this->Navigations_model->find($key);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		// Delete 
		$this->sitemodel->delete("tab_nav", ["nav_id"=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully remove data.";
		echo json_encode($this->response);
		exit;
	}
}
