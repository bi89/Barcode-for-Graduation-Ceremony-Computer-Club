<?php

class Profile extends CI_Controller {
    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('login');
        }
        $this->load->model('profile_data');
    }
    function index(){
        redirect("profile/view");
    }
    function view(){
        $user = $this->ion_auth->user()->row();
        $data = array();
        $data['user'] = $user;
        $data['user_id'] = $user->id;
        $data['idnumber'] = $user->username;
        $data['email'] = $user->email;
        $data['profile'] = $this->profile_data->get_all_profile_in_step($user->id, 1);

        $data['header_data'] = array(
            'title' => 'ดูข้อมูลส่วนตัว',
            'page' => 'home'
        );
        $data['footer_data'] = array(
            'file' => ''
        );
        $this->load->view('profile_view', $data);
    }
    function edit(){
        $user = $this->ion_auth->user()->row();
        $data = array();
        $data['user'] = $user;
        $data['user_id'] = $user->id;
        $data['idnumber'] = $user->username;
        $data['email'] = $user->email;
        $data['success'] = false;
        $data['header_data'] = array(
            'title' => 'แก้ข้อมูลส่วนตัว',
            'page' => 'home'
        );
        $data['footer_data'] = array(
            'file' => ''
        );

        // When Updating fields
        if($_POST){
            
            $step = $this->input->post('step');
            $old_fields = $this->profile_data->get_all_profile_in_step($user->id, $step);

            foreach($old_fields as $field){
                $field_name = $field['profile_name'];
                $new_value = $this->input->post($field_name);
                if($field['value'] != $new_value){
                    $this->profile_data->update_profile($user->id, $field['profile_id'], $new_value);
                }
            }

            $data['success'] = true;
        }

        // When showing forms
        if($_GET){
            $step = $this->input->get('step');
            $data['step'] = $step;
            $data['fields'] = $this->profile_data->get_all_profile_in_step($user->id, $step);
            $this->load->view('profile_edit', $data);
        }
    }
}