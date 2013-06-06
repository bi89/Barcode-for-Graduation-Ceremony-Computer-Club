<?php
class graduate extends CI_Model {

	public function __construct(){
		//default
	}

	public function get_graduate($id){
		$this->db->select()->from('graduate')->where('id', $id);
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

	public function get_graduate_by_keys($where = array()){
		$this->db->select()->from('graduate')->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}

}