<?php
class graduate_info extends CI_Model {

	public function __construct(){
		//default
	}

	public function get_graduate_info($id){
		$this->db->select()->from('graduate_info')->where('id', $id);
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

	public function get_graduate_info_by_keys($where = array()){
		$this->db->select()->from('graduate_info')->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}


}