<?php

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    function index(){

        if($this->ion_auth->logged_in()){
            redirect("home");
        }

        // Initialize data for view
        $data = array(
            'error' => 0
        );

        $data['header_data'] = array(
            'title' => 'ล็อกอิน',
            'page' => 'login'
        );
        $data['footer_data'] = array(
            'file' => ''
        );

        if($_POST){
            $identity = $this->input->post('email');
            $password = $this->input->post('password');
            $login_success = $this->ion_auth->login($identity, $password);
            if($login_success){
                redirect("home");
            } else {
                $data['error'] = 1;
            }
        }
        
        $this->load->view('login', $data);
    }

    function logout(){
        $this->ion_auth->logout();
        redirect();
    }

}