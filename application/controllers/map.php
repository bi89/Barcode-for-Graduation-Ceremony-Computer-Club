<?php

class Map extends CI_controller {
    function index(){
        $this->load->model('barcode');
        $this->load->model('graduate_all');

        $header_data = array(
            'page' => 'map',
        );

        $graduates = $this->graduate_all->get_all_graduate('id', 'name');

        $data = array(
            'header_data' => $header_data,
            'graduates' => $graduates
        );

        $data['header_data'] = array(
            'title' => 'Mapping',
            'page' => 'map',
        );
        $data['footer_data'] = array(
            'file' => '');

        if($_POST){
            $this->barcode->add_barcode($_POST['id'], $_POST['barcode_no']);
            $data['id'] = $_POST['id'];
            $data['barcode_no'] = $_POST['barcode_no'];
        }

        $this->load->view('map', $data);
    }
}