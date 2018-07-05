<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('csdatabase');
        $this->load->helper(array('captcha','download'));
        $this->load->library(array('encrypt','upload'));
    }

    public $binds, $docFullPath, $codeFullPath;

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
 
//---------------------Start coding for register a member----------//
    function create_member() {
            //First, delete old capchas
            $expiration = time() - 900; //30 min left
            $this->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration);
            $this->binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
            //Field name, error, message validation
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[50]'),
                array('field' => 'faculty_name', 'label' => 'Faculty Name', 'rules' => 'trim|callback_required_faculty'),
                array('field' => 'drpDepartmentName', 'label' => 'Department Name', 'rules' => 'trim|callback_required_dept'),
                array('field' => 'year', 'label' => 'Year', 'rules' => 'trim'),
                array('field' => 'semister', 'label' => 'Semister', 'rules' => 'trim'),
                array('field' => 'student_id', 'label' => 'Student Id', 'rules' => 'trim|required|is_natural|min_length[6]|max_length[6]|callback_id_check'),
                array('field' => 'date_of_birth', 'label' => 'Birth Date', 'rules' => 'trim|required'),
                array('field' => 'resident', 'label' => 'Resident', 'rules' => 'required'),
                array('field' => 'field_of_interest', 'label' => 'field_of_interest', 'rules' => 'trim'),
                array('field' => 'expline_interest', 'label' => 'Expline Interest', 'rules' => 'trim|required'),
                array('field' => 'contract_no', 'label' => 'Contact No', 'rules' => 'trim|required|min_length[5]|max_length[12]'),
                array('field' => 'email_address', 'label' => 'Email', 'rules' => 'trim|required|valid_email|min_length[12]|max_length[100]|callback_email_check'),
                array('field' => 'confirm_email_address', 'label' => 'Email confirmation', 'rules' => 'trim|required|matches[email_address]'),
                array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[4]|max_length[32]'),
                array('field' => 'password2', 'label' => 'Password confirmation', 'rules' => 'trim|required|matches[password]'),
                array('field' => 'captcha', 'label' => 'Captcha', 'rules' => 'trim|required|callback_captcha_check')
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE)
            {
                $this->registration();
            } 
            else
            {
                if ($error = $this->csdatabase->create_member()) 
                {
                    if(count($_POST['chkGroups']) > 1)
                    {
                        $group_data = array(
                            array(
                                'StudentId' => $_POST['student_id'],
                                'GroupId'   => $_POST['chkGroups'][0]
                            ),
                            array(
                                'StudentId' => $_POST['student_id'],
                                'GroupId'   => $_POST['chkGroups'][1]
                            )
                        );
                        $this->db->insert_batch('member_group',$group_data);
                        
                        $data = array(
                            'content' => 'error/message',
                            'legend'  => '<b style="color:green"> Welcome : ></b>',
                            'message' => "<b style='color:blue'>Successfully applied for registration. Request proceed...</b>",
                            'leftContent' => 'registration/login'
                        );
                        $this->index($data);
                    }
                    else
                    {
                        $group_data = array(
                              'StudentId' => $_POST['student_id'],
                              'GroupId'   => $_POST['chkGroups'][0]
                        );
                        $this->db->insert('member_group',$group_data);
                        
                        $data = array(
                            'content' => 'error/message',
                            'legend'  => '<b style="color:green"> Welcome : ></b>',
                            'message' => "<b style='color:blue'>Successfully applied for registration. Request proceed...</b>",
                            'leftContent' => 'registration/login'
                        );
                        $this->index($data);
                    }
                }
                else
                {
                    $data = array(
                        'content' => 'error/message',
                        'legend'  => '<b style="color:green">Error ></b>',
                        'message' => "<b style='color:red'>$error</b>",
                        'leftContent' => 'registration/login'
                    );
                    $this->index($data);
                }
            }
    }

    //callback function  
    function captcha_check() {
        // clean up old captchs that have expired
        //Then see if a captcha exist
        $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        $query = $this->db->query($sql, $this->binds);
        $row = $query->row();
        if ($row->count == 0) {
            $this->form_validation->set_message('captcha_check', 'The Captcha text you enter did not match.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    //callback function
    function required_dept($str){
            if ($str == 'default'){
		$this->form_validation->set_message('required_dept', 'The %s not selected');
		return FALSE;
            }
            else{return TRUE;}
     }
    //callback function
    function required_faculty($str){
            if ($str == 'default'){
		$this->form_validation->set_message('required_faculty', 'The %s not selected');
		return FALSE;
            }
            else{return TRUE;}
     }
     //callback function
     function id_check($id){
        $sql = "SELECT COUNT(*) AS countt FROM members WHERE StudentId = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row();
        if ($row->countt == 1) {
            $this->form_validation->set_message('id_check', 'This User Id already registered.');
            return FALSE;
        } else {
            return TRUE;
        }
     }
    //callback function
    function email_check($email) {
        $sql = "SELECT COUNT(*) AS count FROM members WHERE Email = ?";
        $query = $this->db->query($sql, array($email));
        $row = $query->row();
        if ($row->count == 1) {
            $this->form_validation->set_message('email_check', 'This email already Used.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function registration() {
        if(!$this->session->userdata('isLogedIn'))
        {
            $font = rand(1, 2);
            $vals = array(
                'img_path' => './captcha/', //captcha image directory
                'img_url' => base_url() . 'captcha/',
                'img_width' => '325',
                'img_height' => '40',
                'font_path' => "./captcha/fonts/{$font}.ttf",
                'expiration' => '900' //After 30 minuts captcha is delete
            );
            $data['cap'] = create_captcha($vals);
            $data['font'] = $font;
            $data['leftContent'] = 'registration/login';
            $data['content'] = 'registration/registration';
            $this->index($data);
        }
        else
        {
            $data = array(
                  'content' => 'error/generalMessage',
                  'generalLegend'  => '<b style="color:green"> Error : ></b>',
                  'generalMessage' => "<b style='color:red'>You are already registered.</b>"
            );
            $this->index($data);
        }
    }
    
    function forgot_password(){
        $val = $this->form_validation;
	// Set form validation rules
	$val->set_rules('login', 'Email address', 'trim|required|valid_email|xss_clean|callback_check_db_email');

	// Validate rules and call forgot password function
	if ($val->run() == FALSE){
            $data = array('leftContent' => 'registration/forgot_password', 'content' => 'home');
            $this->index($data);
	}else{
            if($this->recover_password($val->set_value('login'))){
                $data = array(
                    'content' => 'error/message',
                    'legend'  => '<b style="color:green">Send Mail:</b>',
                    'message' => "<b style='color:red'>Password has been send your mail. Please Check your mail inbox or spam.</b>",
                    'leftContent' => 'registration/login'
                );
                $this->index($data);
            }
            else
            {
               echo 'Error when sending password in the mail';
            }
	}
    }
    //callback function
    function check_db_email($email){
        $query = $this->db->where('Email',$email)->get('members');
        if($query->num_rows() == 1)
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_db_email','The email is not in our record.');
            return FALSE;
        }
    }
    function recover_password($email){
       $duetCS = new DuetCS;
       $to      = $email;
       $query   = $this->db->select('StudentId, password')
                           ->get_where('members',array('Email'=>$email));
       $result  = $query->result();
       $password= $this->encrypt->decode($result[0]->password);
       $from = 'cs@duetcs.org';
       $name = 'DUET Computer Society';
       $subject = 'Password Recovery';
       $message = 'Your UserId: '.$result[0]->StudentId.'and password: '.$password;
       $mail_sent = $duetCS->email_send($to,$from,$name,$subject,$message);
       if($mail_sent)
       {
           return TRUE;
       }
       else
       {
           return FALSE;
       }
    }

//----------------End coding for register a member------------------------//

//-----------Start coding for Login and Logout of right side------------//
    function validata_login() 
    {
        $this->form_validation->set_rules('userId', 'User Id', 'trim|required|min_length[6]|max_length[6]|is_natural|callback_check_registration_status');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $var      = $this->form_validation;
            $userId   = $var->set_value('userId');
            $password = $var->set_value('password');
            $remember = $this->input->post('rember_me');
            $data     = $this->csdatabase->GetUserInfo($userId, $password);
            
            if (!empty($data)) {
                if (!empty($remember)) {
                    $sessionId = sha1(mt_rand(0, PHP_INT_MAX) . time());
                    $cookie = array(
                        'name'  => 'remember',
                        'value' => $userId . "\n" . $sessionId,
                        'expire'=> 604800, //604800 sec = 1 week
                        'domain'=> $this->config->item('cookie_domain'),
                        'path'  => $this->config->item('cookie_path'),
                        'secure'=> $this->config->item('cookie_secure')
                    );
                    $this->input->set_cookie($cookie);
                }
                $sessionData = array(
                    'userName'  => $data[0]->Name,
                    'userId'    => $userId,
                    'email'     => $data[0]->Email,
                    'password'  => $password,
                    'admin'     => $data[0]->Admin,
                    'isLogedIn' => TRUE
                );
                $this->session->set_userdata($sessionData);
                $this->index();
            } else {
                $error = 'Incorrect Password.';
                $data['leftContent'] = 'registration/login';
                $data['content'] = 'home';
                $this->index($data, $error);
            }
        }
    }
    //callback function
    function check_registration_status($userId) {
        $sql = "SELECT user_level FROM members WHERE StudentId = ?";
        $query = $this->db->query($sql, array($userId));
        $row = $query->num_rows();
        if ($row < 1) {
            $this->form_validation->set_message('check_registration_status', 'You are not yeat registered.');
            return FALSE;
        } else {
            $result = $query->result();
            if($result[0]->user_level == 0){
                $this->form_validation->set_message('check_registration_status', 'Your registration not complete, waiting for administration approvement');
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }
    function logout() {
        $this->session->unset_userdata($this->session->all_userdata());
        $this->index();
    }
//----------------End coding for Login and Logout of right side----------------//
//-----------Start coding for Project----------//
    function add_a_new_project(){
        if($this->session->userdata('isLogedIn'))
        {
            $this->form_validation->set_rules('projectTitle', 'Project Title', 'trim|required|max_length[150]');
            $data = array(
                    'leftContent' => 'registration/login',
                    'content' => 'project/add_new_project'  
            );
            $errors = '';
            $uploadPath = FCPATH.'project/'.$this->session->userdata('userId').'/';
            if(!is_dir($uploadPath))
                mkdir($uploadPath, 0777, TRUE);
            if($this->form_validation->run() == FALSE)
                $this->index($data);
            else
            {
                // For upload Project Documentation
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'pdf';
                $config['overwrite']     = TRUE;
                $config['max_size']      = '100';
                $config['max_filename']  = '50';
                $config['remove_spaces'] = TRUE;
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload("ProjectDoc"))
                {
                    $errors .= $this->upload->display_errors('<li>','</li>');
                    $data['field_errors'] = $errors;
                    $this->index($data);
                }
                else
                {
                    $this->docFullPath = 'project/'.$this->session->userdata('userId').'/'.$this->upload->file_name;
                    // For Uploading Project Code
                    $config['upload_path']   = $uploadPath;
                    $config['allowed_types'] = 'zip';
                    $config['overwrite']     = TRUE;
                    $config['max_size']      = '1024';
                    $config['max_filename']  = '50';
                    $config['remove_spaces'] = TRUE;
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload("ProjectCode"))
                    {
                            $errors .= $this->upload->display_errors('<li>','</li>');
                            $data['field_errors'] = $errors;
                            $this->index($data);
                    }
                    else
                    {
                        $this->codeFullPath = 'project/'.$this->session->userdata('userId').'/'.$this->upload->file_name;
                        $projectHistory['ProjectName']          = $this->input->post('projectTitle');
                        $projectHistory['UploadDate']           = date("Y-m-d");
                        $projectHistory['ProjectDocumentation'] = $this->docFullPath;
                        $projectHistory['ProjectCode']          = $this->codeFullPath;
                        $projectHistory['StudentId']            = $this->session->userdata('userId');
                        if($this->csdatabase->SaveProjectHistory($projectHistory))
                        {
                            $data = array(
                                'content' => 'error/generalMessage',
                                'generalLegend'  => '<b style="color:#000">Saved ></b>',
                                'generalMessage' => '<b style="color:green">Project Saved Successfully.</b>'
                            );
                            $this->index($data);
                        }
                        else
                        {
                            $data = array(
                                'content' => 'error/generalMessage',
                                'generalLegend'  => '<b style="color:#green">Error ></b>',
                                'generalMessage' => '<b style="color:red">Upload error.</b>'
                            );
                            $this->index($data);
                        }
                    }
                }
            }
        }
        else
        {
            $data = array(
                'content' => 'error/message',
                'legend'  => '<b style="color:green">Error ></b>',
                'message' => '<b style="color:red">To Upload Project You Must Loged In.</b>',
                'leftContent' => 'registration/login'
              );
              $this->index($data);
        }
    }
    function show_all_project(){
        $projectTable = $this->csdatabase->GetAllProject();
        $data['projectTable']= $projectTable;
        $data['leftContent'] = 'registration/login';
        $data['content']     = 'project/show_all_project';
        $this->index($data);
    }
    /*function download_project($filename, $projectId){
        if($filename == 'documentation.pdf')
        {
           $downloadUrl = $this->csdatabase->GetDownloadUrl('ProjectDocumentation',$projectId);
        }
        else
        {
           $downloadUrl = $this->csdatabase->GetDownloadUrl('ProjectCode',$projectId);
        }
        $data = file_get_contents($downloadUrl);
        force_download($filename, $data);
    }*/
//-----------End coding for Project------------//
//-----------Start coding for Album------------//
    function photo_album(){
        if($this->session->userdata('isLogedIn'))
        {
            $data['content']     = 'photo_album';
            $this->index($data);
        }else
        {
            $data = array(
                'leftContent' => 'registration/login',
                'content'=>'photo_album'
            );
            $this->index($data);
        }
    }
    function upload_photo(){
        if($this->session->userdata('isLogedIn'))
        {
            $message = '1. '.anchor('https://imgur.com/signin', 'Go There', array('target' => '_blank')).' and login using this email password.'.br();
            $message.= '2. <b>Email :</b> duetcs2010@gmail.com <b>Password :</b> duetcs'.br();
            $message.= '3. Now upload image in your chooseable album.';
            $data = array(
                   'content' => 'error/generalMessage',
                   'generalLegend'  => '<b style="color:#0000FF">Instruction: ></b>',
                   'generalMessage' => '<span style="color:#000">'.$message.'</span>'
             );
            $this->index($data);
        }else
        {
            $data = array(
                   'content' => 'error/generalMessage',
                   'generalLegend'  => '<b style="color:#00F00F">Error: ></b>',
                   'generalMessage' => '<b style="color:#FF0000">You must login to upload image.</b>',
                   'leftContent' => 'registration/login'
             );
            $this->index($data);
        }
    }
//-----------End coding for Album------------//
    function ShowNotice($noticeId){
        $data = array(
            'leftContent' => 'registration/login',
            'content' => 'news/ShowNotice',
            'noticeId'=>$noticeId
        );
        $this->index($data);
    }
    function ShowAllNotice(){
        $data = array('leftContent' => 'registration/login','content' => 'news/ShowAllNotice');
        $this->index($data);
    }
    function AddNewNotice(){
        $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
        if($condition)
        {
            $config = array(
                array('field' => 'entry_name', 'label' => 'Notice Heading', 'rules' => 'trim|required|max_length[150]'),
                array('field' => 'entry_body', 'label' => 'Notice Body', 'rules' => 'trim|required|addslashes')  
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $data = array('content' => 'news/addNotice');
                $this->index($data);
            }else{
                $notice_id = $this->csdatabase->CreateNotice();
                if($this->session->userdata('userName')){
                    redirect('/welcome/ShowNotice/'.$notice_id);
                }
            }
        }
        else
        {
            $data = array(
                'content'       => 'error/generalMessage',
                'generalLegend' => '<b style="color:green"> Error : ></b>',
                'generalMessage'=> "<b style='color:red'>Only admin can post the notice.</b>",
                'leftContent'   => 'registration/login'
              );
              $this->index($data);
        }
    }
    
    function UpdateNotice(){
        $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
        if($condition)
        {
            $config = array(
                array('field' => 'entry_name', 'label' => 'Notice Heading', 'rules' => 'trim|required|max_length[150]'),
                array('field' => 'entry_body', 'label' => 'Notice Body', 'rules' => 'trim|required|addslashes')  
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $data = array('content' => 'news/editNotice');
                $this->index($data);
            }else{
                if($this->csdatabase->UpdateNotice() && $this->session->userdata('userName')){
                    redirect('/welcome/ShowNotice/'.$this->input->post('news_id'));
                }
            }
        }
        else
        {
            $data = array(
                'content'       => 'error/generalMessage',
                'generalLegend' => '<b style="color:green"> Error : ></b>',
                'generalMessage'=> "<b style='color:red'>Only admin can update the notice.</b>",
                'leftContent'   => 'registration/login'
              );
              $this->index($data);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */