<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Vehicle_model extends CI_Model{
	function find($key=""){
		$this->db->select("*");
		if ( empty($key) == FALSE )
			$this->db->where("KendaraanId", $key);
		$q = $this->db->get("vw_kendaraan");
		if ( $q->num_rows() == 0 )
			return FALSE;
		return $q->result();
	}

	/*** DATATABLE SERVER SIDE FOR VEHICLE ***/
	function _get_view_query(){
		$__order 			= array('KendaraanId' => 'ASC');
		$__column_search 	= array('KendaraanId', 'JenisKendaraan');
		$__column_order     = array('KendaraanId', 'JenisKendaraan');

		$this->db->select('*');
		$this->db->from('vw_kendaraan');

		$i = 0;
		$search_value = $this->input->post('search')['value'];
		foreach ($__column_search as $item){
			if ($search_value){
                if ($i === 0){ // looping awal
                	$this->db->group_start(); 
                	$this->db->like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                else{
                	$this->db->or_like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                if (count($__column_search) - 1 == $i) $this->db->group_end(); 
            }
            $i++;
        }

        /* order by */
        if ($this->input->post('order') != null){
        	$this->db->order_by($__column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if (isset($__order)){
        	$order = $__order;
        	$this->db->order_by(key($order), $order[key($order)]);
        }

    }

    function get_view(){
    	$this->_get_view_query();
    	if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
    	$query = $this->db->get();
    	return $query->result();
    }

    function get_view_count_filtered(){
    	$this->_get_view_query();
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function get_view_count_all(){
    	$this->db->from('vw_kendaraan');
    	return $this->db->count_all_results();
    }

    Public Function vEmployee($plat, $id)
    {
        $result = array();
        $this -> db -> select("a.GroupKendaraanId, a.KendaraanId, a.JenisKendaraan,
	                                a.IdPengguna, a.NoKendaraan");
        $this -> db -> from("vw_kendaraan_karyawan a");
        $this -> db -> where("a.NoKendaraan", $plat);
        $this -> db -> where("a.IdPengguna", $id);
        $query = $this -> db -> get();

        return $query->row_array();
    }

    Public Function saveinVehicles($datas)
    {
        if( $this -> db -> insert("tr_activity_vehicles", $datas) ) {
            $id =  $this -> db -> insert_id();

            $this -> db -> set("ActivityVehiclesId", $id);
            $this -> db -> set("KendaraanID", $datas['KendaraanId']);
            $this -> db -> set("IDEmployee", $datas['IDEmployee']);
            $this -> db -> set("Plat", $datas['Plat']);
            $this -> db -> set("Status", 1);
            $this -> db -> set("DateTs", date("Y-m-d H:i:s"));
            $this -> db -> insert("tr_activity_vehicles_log");
        }
    }

    Public Function vMotor($plat, $id)
    {
        $result = array();
        $this -> db -> select("*");
        $this -> db -> from("tr_activity_motor a");
        $this -> db -> where("a.Plat", $plat);
        $this -> db -> where("a.IDEmployee", $id);
        $query = $this -> db -> get();

        return $query->row();
    }

    Public Function employee($plat, $id)
    {
        $result = array();
        $this -> db -> select("*");
        $this -> db -> from("tr_activity_motor a");
        $this -> db -> where("a.Plat", $plat);
        $this -> db -> where("a.IDEmployee", $id);
        $query = $this -> db -> get();

        return $query->row();
    }

    Public Function checkParking($plat, $id)
    {
        $result = array();
        $this -> db -> select("*");
        $this -> db -> from("tr_activity_vehicles a");
        $this -> db -> where("a.Plat", $plat);
        $this -> db -> where("a.IDEmployee", $id);
        $this -> db -> where("a.DateOutTs IS NULL", NULL, false);
        $query = $this -> db -> get();

        return $query->row_array();
    }

    Public Function saveoutVehicles($datas)
    {
        if( $this -> db -> insert("tr_activity_vehicles_log", $datas) ) {
            $this -> db -> set("DateOutTs", date("Y-m-d H:i:s"));
            $this -> db -> where("ActivityVehiclesId", $datas['ActivityVehiclesId']);
            $this -> db -> where("IDEmployee", $datas['IDEmployee']);
            $this -> db -> where("Plat", $datas['Plat']);
            $this -> db -> update("tr_activity_vehicles");
        }
    }
}