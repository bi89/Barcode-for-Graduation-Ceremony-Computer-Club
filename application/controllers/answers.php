<?php

class Answers extends CI_Controller {
    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('login');
        }
        $this->load->model('userans');
    }

    // http://register.fecampchula.net/answers
    function index(){
        redirect("answers/view");
    }

    // http://register.fecampchula.net/answers/view
    function view(){
        $user = $this->ion_auth->user()->row();
        $data = array();
        $data['user'] = $user;
        $data['user_id'] = $user->id;
        $data['idnumber'] = $user->username;
        $data['email'] = $user->email;
        $data['answers'] = $this->userans->get_all_answers($user->id);

        $data['header_data'] = array(
            'title' => 'ดูคำตอบ',
            'page' => 'answers_view'
        );
        $data['footer_data'] = array(
            'file' => ''
        );
        $this->load->view('answers_view', $data);
    }

    // http://register.fecampchula.net/answers/edit
    function edit(){
        $user = $this->ion_auth->user()->row();
        $data = array();
        $data['user'] = $user;
        $data['user_id'] = $user->id;
        $data['idnumber'] = $user->username;
        $data['email'] = $user->email;
        $data['success'] = false;
        $data['header_data'] = array(
            'title' => 'แก้คำตอบ',
            'page' => 'answers_edit'
        );
        $data['footer_data'] = array(
            'file' => ''
        );

        // When Updating fields
        if($_POST){

            $old_fields = $this->userans->get_all_answers($user->id);

            foreach($old_fields as $field){
                $field_name = $field['question_name'];
                $new_value = $this->input->post($field_name);
                if($field['value'] != $new_value){
                    $this->userans->update_answer($user->id, $field['question_id'], $new_value);
                }
            }

            $data['success'] = true;
        }

        // When showing forms
        $data['fields'] = $this->userans->get_all_answers($user->id);
        $this->load->view('answers_edit', $data);
    }
}