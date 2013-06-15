<?php
class barcode extends CI_Model {

	public function __construct(){
		//default
	}

	public function add_barcode($id, $barcode){
		//$this->db->where(array('barcode_no'=>$barcode))->update('barcode', array('id'=>$id, 'barcode_no'=>$barcode));
		$this->db->insert('barcode', array('id'=>$id, 'barcode_no'=>$barcode));
	}

    public function get_graduate_id($barcode){
        $this->db->select()->from('barcode')->where('barcode_no', $barcode);
        $query = $this->db->get();
        if($query->num_rows > 0){
            $result = $query->result_array();
            $query->free_result();
            return $result[0]['id'];
        }
        else{
            return false;
        }
    }
}