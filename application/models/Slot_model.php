<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Slot_model extends CI_Model{
	function find($key=""){
		$this->db->select("*");
		if ( empty($key) == FALSE )
			$this->db->where("slot_id", $key);
		$q = $this->db->get("vw_slot");
		if ( $q->num_rows() == 0 )
			return FALSE;
		return $q->result();
	}

	/*** DATATABLE SERVER SIDE FOR VEHICLE ***/
	function _get_view_query(){
		$__order 			= array('slot_id' => 'ASC');
		$__column_search 	= array('slot_id', 'JenisKendaraan', 'slot_count');
		$__column_order     = array('slot_id', 'JenisKendaraan', 'slot_count');

		$this->db->select('*');
		$this->db->from('vw_slot');

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
    	$this->db->from('vw_slot');
    	return $this->db->count_all_results();
    }
}