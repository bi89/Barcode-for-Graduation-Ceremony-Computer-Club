<?php

class Verify_crud extends CI_Controller {
    function index()
    {
        $this->load->library('grocery_crud');
        $crud = new grocery_CRUD();
        $crud->set_table('verifies');
        $crud->columns("id", "round", "time", "status");
     
        $output = $crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null)
    {
        $output->header_data = array(
            'title' => 'ประวัติการเช็คชื่อ',
            'page' => 'verify_crud',
        );
        $output->footer_data = array(
            'file' => ''
        );
        $this->load->view('example.php',$output);    
    }
}