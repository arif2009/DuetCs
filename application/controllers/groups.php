<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class Groups extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('csdatabase');
    }
    public function index($data = array('leftContent' => 'registration/login', 'content' => 'home'), $error = '') {
        $template = new MyTemplate;
        $duetCS = new DuetCS;
        $data['metaTag']= $template->MetaTag();
        $data['head']   = $template->Head();
        $data['header'] = $template->Header();
        $data['footer'] = $template->Footer();
        
        if($this->session->userdata('isLogedIn')){
            $data['legend'] = 'Congratulation !';
            $data['message'] = anchor('welcome/logout', 'Logout').' | '.anchor('administration/edit_info', 'Edit my info');
            $data['leftContent'] = 'error/message';
        }
        $data['login_error'] = $error;
        $this->load->view('master', $data);
    }
    function executive_body(){
         $data = array(
             'content'     => 'groups/executive_body',
             'leftContent' => 'registration/login',
             'group_table' => $this->csdatabase->GetAllGroup(),
             'group_member'=> $this->csdatabase->get_all_executive_member()
         );
         $this->index($data);
    }
    function show_all_member(){
         $data = array(
             'content'     => 'groups/all_member',
             'leftContent' => 'registration/login',
             'group_table' => $this->csdatabase->GetAllGroup(),
             'group_member'=> $this->csdatabase->get_all_member()
         );
         $this->index($data);
    }
    function application_project(){
         $data = array(
             'content'     => 'groups/application_project',
             'leftContent' => 'registration/login',
             'group_table' => $this->csdatabase->GetAllGroup()
         );
         $this->index($data);
    }
    function developers(){
        $data = array(
             'content'     => 'groups/developers',
             'leftContent' => 'registration/login',
             'group_table' => $this->csdatabase->GetAllGroup()
         );
         $this->index($data);
    }
    function show_all_x_std()
    {
        $data = array(
             'content'     => 'groups/x_std',
             'leftContent' => 'registration/login',
             'batch_table'=> $this->csdatabase->get_all_batch(),
             'group_table' => $this->csdatabase->GetAllGroup()
         );
         $this->index($data);
    }
    function show_ind_x_std($batch)
    {
        $data = array(
             'content'     => 'groups/x_std_by_batch',
             'leftContent' => 'registration/login',
             'batch_std'=> $this->csdatabase->get_individual_batch($batch),
             'group_table' => $this->csdatabase->GetAllGroup()
         );
         $this->index($data);
    }
}
