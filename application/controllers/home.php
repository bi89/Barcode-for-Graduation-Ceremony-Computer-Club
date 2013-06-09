<?php

class Home extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('graduate_info');
        $this->load->model('graduate_status');
        $this->load->model('round');
        $this->load->model('verifies');
        $this->load->model('barcode');
        date_default_timezone_set('Asia/Bangkok');
    }
    function index(){

        $data = array();
        $data['rounds'] = $this->round->get_rounds();
        $data['success'] = -1;
        $data['graduate_info'] = false;
        $data['graduate_status'] = false;
        $data['previous'] = false;
        $data['wrong_order'] = false;
        $data['flag'] = false;

        $data['header_data'] = array(
            'title' => 'เช็คชื่อ',
            'page' => 'home',
        );
        $data['footer_data'] = array(
            'file' => "
<script>
$(function() {
    $('#id').focus();
});
</script>
            "
        );

        if($_POST){
            $id = $this->input->post('id');
            if(strlen($id) == 14){
                $id = $this->barcode->get_graduate_id($id);
                echo $id;
            }
            $round = $this->input->post('round');
            $status = $this->input->post('status');
            $previous_order = $this->input->post('previous');
            $data['round'] = $round;
            $data['graduate_info'] = $this->graduate_info->get_graduate_info($id);
            $current_order = $data['graduate_info']['order'];

            //Check for correct ordering
            if($previous_order){
                if($current_order == $previous_order || $current_order == $previous_order+1){
                    $data['wrong_order'] = false;
                }
                else{
                    if($current_order == $previous_order+2){
                        $data['wrong_order'] = 'ลำดับ '.($previous_order+1).' หายไป';
                        $data['flag'] = 'warning';
                    }
                    else if($current_order < $previous_order){
                        $data['wrong_order'] = 'ไม่อนุญาตให้เข้า';
                        $data['flag'] = 'danger';
                    }
                    else{
                        $data['wrong_order'] = 'ลำดับ '.($previous_order+1).' - '.($current_order-1).' หายไป';
                        $data['flag'] = 'warning';
                    }
                }
            }

            $data['previous'] = $data['graduate_info']['order'];
            if($status == 'ok' && $data['flag'] != 'danger'){
                $data['success'] = $this->verifies->add_verify($id, $round);
            }
            if($status == 'cancel'){
                $data['success'] = $this->verifies->cancel_verify($id, $round);
            }
            //Get Status AFTER verifying
            $data['graduate_status'] = $this->graduate_status->get_graduate_status($id);
        }

        /* auto-select time */
        $current_time = time();
        for($i = 0; $i < count($data['rounds']) ; $i++){
            $data['rounds'][$i]['current'] = 0;
        }

        for($i = 0; $i < count($data['rounds']) ; $i++){
            $t = strtotime($data['rounds'][$i]['datetime']);
            if($t <= $current_time + 3600){
                $data['rounds'][$i]['current'] = 1;
            }
        }
        $data['header_data']['flag'] = $data['flag'];
        $this->load->view('home', $data);
    }
}