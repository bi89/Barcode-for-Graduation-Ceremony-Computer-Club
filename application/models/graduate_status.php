<?php
class graduate_status extends CI_Model {

	public function __construct(){
		//default
	}

	public function get_graduate_status($id){
		$this->db->select()->from('graduate_status')->where('id', $id);
		$query = $this->db->get();
		if($query->num_rows > 0){
			$result = $query->result_array();
			$query->free_result();
			return $result[0];
		}
		else{
			return false;
		}
	}

	public function get_graduate_status_by_keys($where = array()){
		$this->db->select()->from('graduate_status')->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}

}