<?php
class graduate_all extends CI_Model {

	public function __construct(){
		//default
	}

	public function get_graduate($id){
		$this->db->select()->from('graduate_all')->where('id', $id);
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
		$this->db->select()->from('graduate_all')->where($where)->order_by('faculty_name', 'ASC')->order_by('order', 'ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}

	public function get_graduate_by_keys_and_rounds($where = array(), $round = ''){
		if($round){
			$round = "(round1_date = '$round' or round2_date = '$round' or round3_date = '$round')";
			$this->db->select()->from('graduate_all')->where($where)->where($round)->order_by('faculty_name', 'ASC')->order_by('order', 'ASC');
		}
		else{
			$this->db->select()->from('graduate_all')->where($where)->order_by('faculty_name', 'ASC')->order_by('order', 'ASC');
		}
		$query = $this->db->get();
		//var_dump($this->db->last_query());
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}

}