<?php

class Mapping extends CI_Controller {
    function index()
    {
        $this->load->library('grocery_crud');
        $crud = new grocery_CRUD();
        $crud->set_table('barcode');
        $crud->columns('id', 'barcode_no');
     
        $output = $crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null)
    {
        $output->header_data = array(
            'title' => 'Barcode Map',
            'page' => 'mapping',
        );
        $output->footer_data = array(
            'file' => ''
        );
        $this->load->view('example.php',$output);    
    }
}