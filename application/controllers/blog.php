<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class Blog extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('smiley');
        $this->load->library('table');
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
    function post($postId){
        /*$image_array = get_clickable_smileys(base_url('images/smileys'), 'comment');
	$col_array = $this->table->make_columns($image_array, 15);*/
        $data = array(
            //'smiley_table'=>$this->table->generate($col_array),
            'leftContent' => 'registration/login',
            'content' => 'blog/post_and_coments',
            'postId' => $postId
            );
            $this->index($data);
    }
    function add_comment($Id){
        $this->form_validation->set_rules('comment','Comment','trim|required|addslashes');
        $this->form_validation->set_message('required', 'Coment must not be empty');
        if($this->form_validation->run() == FALSE){
            $data = array(
                'content' => 'blog/post_and_coments',
                'postId'=>$Id
            );
            $this->index($data);
        }
        else
        {
            if($this->csdatabase->AddNewComment($Id))
            {
                redirect('blog/post/'.$Id);
            }
        }
    }
    
    function AddNewPost(){
        if($this->session->userdata('isLogedIn')){
            $config = array(
                array('field' => 'entry_name', 'label' => 'Post Heading', 'rules' => 'trim|required|max_length[100]'),
                array('field' => 'entry_body', 'label' => 'Post Body', 'rules' => 'trim|required|addslashes')  
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $data = array('content' => 'blog/add_post');
                $this->index($data);
            }else{
                $insert_id = $this->csdatabase->create_post();
                if($this->session->userdata('userName')){
                    redirect('blog/post/'.$insert_id);
                }
            }
        }else{
            $data = array(
                'content' => 'error/message',
                'legend'  => '<b style="color:green">Error ></b>',
                'message' => '<b style="color:red">To Post Something You Must Loged In.</b>',
                'leftContent' => 'registration/login'
              );
              $this->index($data);
        }
    }
    
    function UpdatePost(){
        if($this->session->userdata('isLogedIn')){
            $config = array(
                array('field' => 'entry_name', 'label' => 'Post Heading', 'rules' => 'trim|required|max_length[100]'),
                array('field' => 'entry_body', 'label' => 'Post Body', 'rules' => 'trim|required|addslashes')  
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $data = array('content' => 'blog/edit_post');
                $this->index($data);
            }else{
                if($this->csdatabase->update_post()){
                    redirect('/blog/post/'.$this->input->post('entry_id'));
                }
            }
        }else{
            $data = array(
                'content' => 'error/message',
                'legend'  => '<b style="color:green">Error ></b>',
                'message' => '<b style="color:red">You Must Loged In To Update.</b>',
                'leftContent' => 'registration/login'
              );
              $this->index($data);
        }
    }
    
    function ShowAllPost(){
        $data = array('leftContent' => 'registration/login','content' => 'blog/all_post');
        $this->index($data);
    }
}
