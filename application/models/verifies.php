<?php
class verifies extends CI_Model {

	public function __construct(){

	}

	public function add_verify($id, $round){
		$this->load->model('graduate');
		if($graduate = $this->graduate->get_graduate($id)){
			if($graduate['round1'] == $round ||
				$graduate['round2'] == $round ||
				$graduate['round3'] == $round){
				$current_status = $this->get_verify($id, $round);

				//Data not found
				if($current_status == false){
					$data = array(
						'id' => $id,
						'round' => $round,
						'status' => 'ok'
					);
					$this->db->insert('verifies', $data); 
					return 1;
				}
				//Data already found
				else if($current_status == 'ok'){
					return 2;
				}
				//Data already found
				else if($current_status == 'cancelled'){
					$data = array(
						'status' => 'ok'
					);
					$this->db->where('id', $id)->where('round', $round);
					$this->db->update('verifies', $data);
					return 1;
				}
			}
			//Wrong round
			else{
				return 3;
			}
		}
		//Wrong ID
		else{
			return 4;
		}
		//Wrong something wrong
		return 0;
	}

	public function cancel_verify($id, $round){
		$this->load->model('graduate');
		if($graduate = $this->graduate->get_graduate($id)){
			if($graduate['round1'] == $round ||
				$graduate['round2'] == $round ||
				$graduate['round3'] == $round){
				$current_status = $this->get_verify($id, $round);

				//Data not found
				if($current_status == false){
					return 0;
				}
				//Data already found
				else if($current_status == 'ok'){
					$data = array(
						'status' => 'cancelled'
					);
					$this->db->where('id', $id)->where('round', $round);
					$this->db->update('verifies', $data);
					return 5;
				}
				//Data already found
				else if($current_status == 'cancelled'){
					return 5;
				}
			}
			//Wrong round
			else{
				return 3;
			}
		}
		//Wrong ID
		else{
			return 4;
		}
		//Something wrong
		return 0;
	}

	public function get_verify($id, $round){
		$this->db->select()->from('verifies')->where('id', $id)->where('round', $round);
		$query = $this->db->get();
		if($query->num_rows > 0){
			$result = $query->result_array();
			$query->free_result();
			return $result[0]['status'];
		}
		else{
			return false;
		}
	}
/*
	public function get_profile($user_id, $profile_id){
		$this->db->select('answer')->from('userprofile')->where('user_id', $user_id)->where('profile_id', $profile_id);
		$query = $this->db->get();
		$result = $query->first_row();
		$query->free_result();
		if($result) return $result->answer;
		else return NULL;
	}

	public function has_profile($user_id, $profile_id){
		if($this->has_profile($user_id, $profile_id)){
			return true;
		}
		return false;
	}

	public function get_all_profile_in_step($user_id, $step){
		$this->db->select()->from('profile')->where('step_id', $step)->order_by('order','asc');
		$query = $this->db->get();
		$fields = $query->result_array();
		$query->free_result();

		$data = array();
		foreach($fields as $field){
			$field_id = $field['profile_id'];
			$field['value'] = $this->get_profile($user_id, $field_id);
			$data[] = $field;
		}

		return $data;
	}
*/
}