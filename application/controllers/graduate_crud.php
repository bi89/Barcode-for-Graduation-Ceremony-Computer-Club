<?php

class Graduate_crud extends CI_Controller {
    function index()
    {
        $this->load->library('grocery_crud');
        $crud = new grocery_CRUD();
        $crud->set_table('graduate');
        $crud->columns("id", "name", "faculty", "order", "round1", "round2", "round3", "image");
     
        $output = $crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null)
    {
        $output->header_data = array(
            'title' => 'รายชื่อนิสิตทั้งหมด',
            'page' => 'graduate_crud',
        );
        $output->footer_data = array(
            'file' => ''
        );
        $this->load->view('example.php',$output);    
    }
}