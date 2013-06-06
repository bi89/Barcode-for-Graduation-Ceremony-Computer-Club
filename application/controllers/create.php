<?php

class Create extends CI_Controller {

    function __construct(){
        parent::__construct();
        if($this->ion_auth->logged_in()){
            redirect('home');
        }
        $this->load->model('profile_fields');
        $this->load->model('profile_data');
    }

    function index(){
        $data = array();
        $field_step0 = $this->profile_fields->get_profile_fields_in_step(0);
        $field_step1 = $this->profile_fields->get_profile_fields_in_step(1);
        $data['fields'] = array_merge($field_step0, $field_step1);
        $data['error'] = 0;
        $data['header_data'] = array(
            'title' => 'สมัครค่าย',
            'page' => 'register'
        );
        $data['footer_data'] = array(
            'file' => ''
        );

        if($_POST){
            
            $username = $this->input->post('idnumber');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $additional_data = array();

            $data['username'] = $username;
            $data['password'] = $password;
            $data['email'] = $email;

            // Show error if username is taken
            if ($this->ion_auth->username_check($username)){
                $data['error'] = 'id_taken';
                $this->load->view('create_account', $data);
                return;
            }

            // Show error if email is taken
            if ($this->ion_auth->email_check($email)){
                $data['error'] = 'email_taken';
                $this->load->view('create_account', $data);
                return;
            }

            // Try to register (table: users)
            $creation_success = $this->ion_auth->register($username, $password, $email, $additional_data);

            if($creation_success){

                $user_id = $creation_success;

                // Enter other fields in (table: userprofile)
                foreach ($data['fields'] as $field) {
                    $field_name = $field['profile_name'];
                    if($field_name != 'idnumber' && $field_name != 'email' && $field_name != 'password'){
                        $profile_data = $this->input->post($field_name);
                        $this->profile_data->add_profile($user_id, $field['profile_id'], $profile_data);
                    }
                }

                $this->load->view('create_account_success', $data);
                return;

            } else { // Something wrong with registration, try again!
                $data['error'] = 'general';
            }
        }

        $this->load->view('create_account', $data);

    }

}