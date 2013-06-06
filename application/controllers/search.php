<?php
class search extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('graduate_all');
        $this->load->model('round');
        $this->load->model('faculty');
        date_default_timezone_set('Asia/Bangkok');
    }
    function index(){

        $data = array();
        $data['rounds'] = $this->round->get_rounds();
        $data['faculties'] = $this->faculty->get_faculties();
        $data['graduates'] = $this->graduate_all->get_graduate_by_keys();
        $data['current'] = false;
        $data['header_data'] = array(
            'title' => 'ทะเบียน',
            'page' => 'search',
            'flag' => false
        );
        $data['footer_data'] = array(
            'file' => "
<script>
    function apply_table_filter(){
        var row = $('#list-table tr');
        row.removeClass('error');
        var filter_round = new Array();
        filter_round[0] = $('#mark1').is(':checked');
        filter_round[1] = $('#mark2').is(':checked');
        filter_round[2] = $('#mark3').is(':checked');
        console.log(filter_round);
        row.each(function(){
            var mythis = $(this);
            var valid = true;
            var checked = false;
            for(var i = 0;i < filter_round.length; i++){
                checked = checked || filter_round[i];
                if(filter_round[i]){
                    valid = valid && !mythis.hasClass('round'+(i+1));
                }
            }

            if(valid && checked){
                mythis.addClass('error');
            }

        });
    }

    apply_table_filter();

    $('.rowfilter').click(function(){
        apply_table_filter();
    });
    $('a').tooltip();
    
</script>
            "
        );

        if($_GET){
            $query = array();
            $data['current'] = $_GET;
            if($this->input->get('id')){
                $query['id'] = $this->input->get('id');
            }
            if($this->input->get('name')){
                $query['name'] = $this->input->get('name');
            }
            if($this->input->get('faculty_name')){
                $query['faculty_name'] = $this->input->get('faculty_name');
            }
            if($this->input->get('from')){
                $query['order >='] = $this->input->get('from');
            }
            if($this->input->get('to')){
                $query['order <='] = $this->input->get('to');
            }
            if($this->input->get('round')){
                $query_round = $this->input->get('round');
            }
            else{
                $query_round = '';
            }
            $data['graduates'] = $this->graduate_all->get_graduate_by_keys_and_rounds($query, $query_round);
        }

        $this->load->view('search', $data);
    }
}