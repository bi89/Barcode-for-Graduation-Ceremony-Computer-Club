<?php
class faculty extends CI_Model {

	public function __construct(){
		//default
	}

	public function get_faculties(){
		$this->db->select()->from('faculty');
		$query = $this->db->get();
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}

	public function get_faculty($id){
		$this->db->select()->from('faculty')->where($id);
		$query = $this->db->get();
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}

}