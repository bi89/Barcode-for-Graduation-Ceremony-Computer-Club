<?php
class round extends CI_Model {

	public function __construct(){
		//default
	}

	public function get_rounds(){
		$this->db->select()->from('round');
		$query = $this->db->get();
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}

	public function get_round_time($id){
		$this->db->select()->from('graduate_status')->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}

}