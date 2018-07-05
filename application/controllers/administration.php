<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class Administration extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('csdatabase');
    }
    public function index($data = array('leftContent' => 'registration/login', 'content' => 'home'), $error = '')
    {
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
            $data['error'] = $error;
        }
        $data['login_error'] = $error;
        $this->load->view('master', $data);
    }
    function delete_post($post_id)
    {
        if($this->session->userdata('isLogedIn'))
        {
            $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
            if($condition OR !$this->csdatabase->is_direct_request_for_post($post_id))
            {
                $tables = array('comment', 'entry');
                $this->db->where('entry_id', $post_id);
                $this->db->delete($tables);
                redirect('blog/ShowAllPost');
            }
            else
            {
                $data = array(
                    'content' => 'error/generalMessage',
                    'generalLegend'  => '<b style="color:green"> Error : ></b>',
                    'generalMessage' => "<b style='color:red'>No direct script access allowed.</b>",
                    'leftContent' => 'registration/login'
                );
                $this->index($data);
            }
        }
        else
        {
           $data = array(
                'content' => 'error/generalMessage',
                'generalLegend'  => '<b style="color:green"> Error : ></b>',
                'generalMessage' => "<b style='color:red'>You must login to delete.</b>",
                'leftContent' => 'registration/login'
            );
            $this->index($data);
        }
    }
    function edit_post($post_id)
    {
        if($this->session->userdata('isLogedIn'))
        {
            $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
            if($condition OR !$this->csdatabase->is_direct_request_for_post($post_id))
            {
                $query = $this->db->get_where('entry',array('entry_id' => $post_id));
                $table = $query->result();
                $data = array(
                    'content'     => 'blog/edit_post',
                    'post'        => $table,
                    'leftContent' => 'registration/login'
                );
                $this->index($data);
            }
            else
            {
                $data = array(
                    'content' => 'error/generalMessage',
                    'generalLegend'  => '<b style="color:green"> Error : ></b>',
                    'generalMessage' => "<b style='color:red'>No direct script access allowed.</b>",
                    'leftContent' => 'registration/login'
                );
                $this->index($data);
            }
        }
        else
        {
           $data = array(
                'content' => 'error/generalMessage',
                'generalLegend'  => '<b style="color:green"> Error : ></b>',
                'generalMessage' => "<b style='color:red'>You must login to edit.</b>",
                'leftContent' => 'registration/login'
            );
            $this->index($data);
        }
    }
    function delete_comment($post_id, $coment_id)
    {
        if($this->session->userdata('isLogedIn'))
        {
            $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
            if($condition OR !$this->csdatabase->is_direct_request_for_comm($coment_id))
            {
                $this->db->where('comment_id', $coment_id);
                $this->db->delete('comment');
                redirect('blog/post/'.$post_id);
            }
            else
            {
                $data = array(
                    'content' => 'error/generalMessage',
                    'generalLegend'  => '<b style="color:green"> Error : ></b>',
                    'generalMessage' => "<b style='color:red'>No direct script access allowed.</b>",
                    'leftContent' => 'registration/login'
                );
                $this->index($data);
            }
        }
        else
        {
           $data = array(
                'content' => 'error/generalMessage',
                'generalLegend'  => '<b style="color:green"> Error : ></b>',
                'generalMessage' => "<b style='color:red'>You must login to delete.</b>",
                'leftContent' => 'registration/login'
            );
            $this->index($data);
        }
    }
    function delete_notice($id)
    {
        if($this->session->userdata('isLogedIn'))
        {
            $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
            if($condition)
            {
                $query = $this->db->get_where('notice',array('Id'=>$id));
                if($query->num_rows() >0)
                {
                    $this->db->where('Id', $id);
                    $this->db->delete('notice');
                    redirect('welcome/ShowAllNotice');
                }
                else 
                {
                    $data = array(
                        'content' => 'error/generalMessage',
                        'generalLegend'  => '<b style="color:green"> Error : ></b>',
                        'generalMessage' => "<b style='color:red'>No direct script allowed here.</b>",
                        'leftContent' => 'registration/login'
                    );
                    $this->index($data);
                }
            }
            else
            {
                $data = array(
                    'content' => 'error/generalMessage',
                    'generalLegend'  => '<b style="color:green"> Error : ></b>',
                    'generalMessage' => "<b style='color:red'>Only admin can delete notice</b>",
                    'leftContent' => 'registration/login'
                );
                $this->index($data);
            }
        }
        else
        {
           $data = array(
                'content' => 'error/generalMessage',
                'generalLegend'  => '<b style="color:green"> Error : ></b>',
                'generalMessage' => "<b style='color:red'>You must login to delete.</b>",
                'leftContent' => 'registration/login'
            );
            $this->index($data);
        }
    }
    function edit_notice($id)
    {
        if($this->session->userdata('isLogedIn'))
        {
            $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
            if($condition)
            {
                $query = $this->db->get_where('notice',array('Id'=>$id));
                $table = $query->result();
                $data = array(
                    'content'     => 'news/editNotice',
                    'notice'        => $table,
                    'leftContent' => 'registration/login'
                );
                $this->index($data);
            }
            else
            {
                $data = array(
                    'content' => 'error/generalMessage',
                    'generalLegend'  => '<b style="color:green"> Error : ></b>',
                    'generalMessage' => "<b style='color:red'>Only admin can edit notice</b>",
                    'leftContent' => 'registration/login'
                );
                $this->index($data);
            }
        }
        else
        {
           $data = array(
                'content' => 'error/generalMessage',
                'generalLegend'  => '<b style="color:green"> Error : ></b>',
                'generalMessage' => "<b style='color:red'>You must login to edit.</b>",
                'leftContent' => 'registration/login'
            );
            $this->index($data);
        }
    }
    
    function requested_student()
    {
        if($this->session->userdata('isLogedIn')){
            $data['content'] = 'administration/requested_student';
            $data['std_list']= $this->csdatabase->requested_student_list();
            $this->index($data);
        }
        else
        {
            $data = array(
                'content' => 'error/generalMessage',
                'generalLegend'  => '<b style="color:green"> Error : ></b>',
                'generalMessage' => "<b style='color:red'>Please Login.........</b>",
                'leftContent' => 'registration/login'
            );
            $this->index($data);
        }
    }
    function view_details($std_id)
    {
        if($this->session->userdata('isLogedIn')){
            $data['content'] = 'administration/view_details';
            $data['stdTable']= $this->csdatabase->view_details($std_id);
            $this->index($data);
        }
        else
        {
            $data = array(
                'content' => 'error/generalMessage',
                'generalLegend'  => '<b style="color:green"> Error : ></b>',
                'generalMessage' => "<b style='color:red'>Please Login.........</b>",
                'leftContent' => 'registration/login'
            );
            $this->index($data);
        }
    }
    function group_manipulation()
    {
        $std_id  = $this->input->post('std_id');
        $group_id= $this->input->post('group_id');
        if($this->input->post('ajax') == '1')
        {
            if($this->csdatabase->remove_stdunt_from_group($std_id, $group_id))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            if($this->csdatabase->add_stdunt_to_group($std_id, $group_id))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            } 
        }
    }
    function accept_executive($std_id)
    {
        if($this->csdatabase->accept_executive($std_id)){
            redirect('administration/requested_student');
        }
    }
    function accept_general($std_id)
    {
        if($this->csdatabase->accept_general($std_id))
        {
            redirect('administration/requested_student');
        }
    }
    function reject($std_id)
    {
        if($this->csdatabase->delete_info($std_id))
        {
            redirect('administration/requested_student');
        }
    }
    function get_std_to_make_admin()
    {
        $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
        if($condition)
        {
            $data = array(
                'content'               => 'administration/make_admin',
                'executive_body_student'=> $this->csdatabase->get_member_to_make_admin()
            );
            $this->index($data);
        }
        else
        {
            $data = array(
                'content' => 'error/generalMessage',
                'generalLegend'  => '<b style="color:green"> Error : ></b>',
                'generalMessage' => "<b style='color:red'>Only admin can permit here</b>",
                'leftContent' => 'registration/login'
            );
            $this->index($data);
        }
    }
    function manage_admin($std_id, $data)
    {
        if($this->csdatabase->update_admin_info($std_id, $data)){
            redirect('administration/get_std_to_make_admin');
        }
    }
    
//Start coding for Edit information of a stuudent
    function edit_info()
    {
       //Field name, error, message validation
       $config = array(
           array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[50]'),
           array('field' => 'faculty_name', 'label' => 'Faculty Name', 'rules' => 'trim|callback_required_faculty'),
           array('field' => 'drpDepartmentName', 'label' => 'Department Name', 'rules' => 'trim|callback_required_dept'),
           array('field' => 'year', 'label' => 'Year', 'rules' => 'trim'),
           array('field' => 'semister', 'label' => 'Semister', 'rules' => 'trim'),
           array('field' => 'date_of_birth', 'label' => 'Birth Date', 'rules' => 'trim|required'),
           array('field' => 'resident', 'label' => 'Resident', 'rules' => 'required'),
           array('field' => 'contract_no', 'label' => 'Contact No', 'rules' => 'trim|required|min_length[5]|max_length[12]'),
           array('field' => 'email_address', 'label' => 'Email', 'rules' => 'trim|required|valid_email|min_length[12]|max_length[100]|callback_email_check'),
           array('field' => 'confirm_email_address', 'label' => 'Email confirmation', 'rules' => 'trim|required|matches[email_address]'),
           array('field' => 'password', 'label' => 'Current Password', 'rules' => 'trim|required|callback_current_password'),
           array('field' => 'password1', 'label' => 'New Password', 'rules' => 'trim|required|min_length[4]|max_length[32]'),
           array('field' => 'password2', 'label' => 'Password confirmation', 'rules' => 'trim|required|matches[password1]')
       );
       $this->form_validation->set_rules($config);

       if ($this->form_validation->run() == FALSE)
       {
           $data['std_data']   = $this->csdatabase->get_std_info_for_update($this->session->userdata('userId'));
           $data['leftContent']= 'registration/login';
           $data['content']    = 'administration/edit_info';
           $this->index($data);
       } 
       else
       {
           if ($this->csdatabase->update_member_info($this->session->userdata('userId'))) 
           {
               $data = array(
                   'content' => 'error/generalMessage',
                   'generalLegend'  => '<b style="color:green"> Updated : ></b>',
                   'generalMessage' => "<b style='color:blue'>Successfully update your information.</b>",
                );
                $this->index($data);
           }
       }
    }
    //callback function
    function required_faculty($str)
    {
            if ($str == 'default'){
                $this->form_validation->set_message('required_faculty', 'The %s not selected');
                return FALSE;
            }
            else{return TRUE;}
     }
    //callback function
    function required_dept($str)
     {
            if ($str == 'default'){
                $this->form_validation->set_message('required_dept', 'The %s not selected');
                return FALSE;
            }
            else{return TRUE;}
     }
     //callback function
     function current_password($str)
     {
         if($str != $this->session->userdata('password')){
             $this->form_validation->set_message('current_password', 'Current password not match');
             return FALSE;
         }
        else {
             return TRUE;
        }
     }
//End coding for Edit information of a stuudent
 
//Start coding for Executive body management
    function select_exec_body()
    {
        if($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002')
        {
           $config = array(
                array('field' => 'stdId', 'label' => 'Student Id', 'rules' => 'trim|required|is_natural|callback_member_check'),
                array('field' => 'position', 'label' => 'Position', 'rules' => 'trim')
           );
           $this->form_validation->set_rules($config);
           if($this->form_validation->run() == FALSE)
           {
                $data['content'] = 'administration/executive_body_management';
                $this->index($data);
           }
           else 
           {
               $std_id   = $this->input->post('stdId');
               $section  = $this->input->post('section');
               $position = $this->input->post('position');
               if($position == 'SectionChief' || $position == 'SectionMember')
               {
                   $data = array(
                            'StudentId'      => $std_id,
                            'GroupId'        => $section,
                            'Responsibility' => $position
                        );
                   if($this->db->insert('executive_body', $data))
                   {
                        $data = array(
                            'content'       => 'administration/executive_body_management'
                        );
                       $this->index ($data, '<b style="color:green">This member added successfully.</b>');
                   }
               }
               else
               {
                    $data = array(
                            'StudentId'      => $std_id,
                            'Responsibility' => $position
                        );
                   if($this->db->insert('executive_body', $data))
                   {
                        $data = array(
                            'content'       => 'administration/executive_body_management'
                        );
                       $this->index ($data, '<b style="color:green">This member added successfully.</b>');
                   }
               }
           }
        }
        else
        {
           $data = array(
              'content'       => 'error/generalMessage',
              'generalLegend' => '<b style="color:green"> Error : ></b>',
              'generalMessage'=> "<b style='color:red'>You are not allowed here.</b>",
              'leftContent'   => 'registration/login'
           );
           $this->index($data);
        }
    }
    
//Callback for member check
     function member_check($id)
     {
        $position = $this->input->post('position');
        $section  = $this->input->post('section');
        if($this->csdatabase->member_exist($id))
        {
            if($position == 'President' OR $position == 'GeneralSecretary' OR $position == 'Finance')
            {
                $sql = "SELECT StudentId FROM executive_body WHERE Responsibility = ?";
                $query = $this->db->query($sql, array($position));
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->form_validation->set_message('member_check', "Id {$row->StudentId} is already assigned this position. If you replace another, please remove first.");
                    return FALSE;
                }
                else
                {
                return TRUE; 
                }
            }
            elseif($position == 'VicePresident' OR $position == 'AssGeneralSecretary' OR $position == 'AFinance')
            {
                $sql = "SELECT StudentId FROM executive_body WHERE Responsibility = ?";
                $query = $this->db->query($sql, array($position));
                if ($query->num_rows() > 0)
                {
                    $row = $query->row_array();
                    if(in_array($id, $row))
                    {
                        $this->form_validation->set_message('member_check', "Id {$id} is already assigned this position.");
                        return FALSE;
                    }
                    else
                    {
                        return TRUE;
                    }
                }
                else
                {
                return TRUE; 
                }
            }
            elseif($position == 'SectionChief')
            {
                $sql = "SELECT StudentId FROM executive_body WHERE Responsibility = ? AND GroupId = ?";
                $query = $this->db->query($sql, array($position, $section));
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row();
                    $this->form_validation->set_message('member_check', "Id {$row->StudentId} is already assigned this position. If you replace another, please remove first.");
                    return FALSE;
                }
                else
                {
                return TRUE; 
                }
            }
            elseif($position == 'SectionMember')
            {
                $sql = "SELECT StudentId FROM executive_body WHERE Responsibility = ? AND GroupId = ?";
                $query = $this->db->query($sql, array($position, $section));
                if ($query->num_rows() > 0)
                {
                    $row = $query->row_array();
                    if(in_array($id, $row))
                    {
                        $this->form_validation->set_message('member_check', "Id {$id} is already assigned this position.");
                        return FALSE;
                    }
                    else
                    {
                        return TRUE;
                    }
                }
                else
                {
                return TRUE; 
                }
            }
        }
        else
        {
            $this->form_validation->set_message('member_check', "Id {$id} is not registered yeat.");
            return FALSE;
        }
     }
    function remove_all()
     {
        $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
        if($condition)
        {
            if($this->db->truncate('executive_body'))
            {   
                $data = array(
                    'content'       => 'error/generalMessage',
                    'generalLegend' => '<b style="color:green"> Error : ></b>',
                    'generalMessage'=> "<b style='color:blue'>Committee remove successfully.</b>",
                    'leftContent'   => 'registration/login'
                );
                $this->index($data);
            }
            else
            {
                $data = array(
                    'content'       => 'error/generalMessage',
                    'generalLegend' => '<b style="color:green"> Error : ></b>',
                    'generalMessage'=> "<b style='color:red'>Some error occured in database.</b>",
                    'leftContent'   => 'registration/login'
                );
                $this->index($data);
            }
        }
        else
        {
           $data = array(
              'content'       => 'error/generalMessage',
              'generalLegend' => '<b style="color:green"> Error : ></b>',
              'generalMessage'=> "<b style='color:red'>You are not allowed here.</b>",
              'leftContent'   => 'registration/login'
           );
           $this->index($data);
        }
    }
    function remove()
    {
        $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
        if($condition)
        {
            $std_id   = $this->input->post('stdId');
            $position = $this->input->post('position');
            $config = array(
                array('field' => 'stdId', 'label' => 'Student Id', 'rules' => 'trim|required|is_natural'),
                array('field' => 'position', 'label' => 'Position', 'rules' => 'trim')
           );
           $this->form_validation->set_rules($config);
           if($this->form_validation->run() == FALSE)
           {
                $data['content'] = 'administration/executive_body_management';
                $this->index($data);
           }else{
               $result = $this->csdatabase->RemoveMemner(array('StudentId'=>$std_id,'Responsibility'=>$position));
               if($result==TRUE){
                   $data['content'] = 'administration/executive_body_management';
                   $this->index ($data, '<b style="color:green">This member removed successfully.</b>');
               }
               else{
                   $data['content'] = 'administration/executive_body_management';
                   $this->index ($data, '<b style="color:green">'.$result.'</b>');
              }
           }
        }
        else
        {
           $data = array(
              'content'       => 'error/generalMessage',
              'generalLegend' => '<b style="color:green"> Error : ></b>',
              'generalMessage'=> "<b style='color:red'>You are not allowed here.</b>",
              'leftContent'   => 'registration/login'
           );
           $this->index($data);
        }
    }
//End coding for Executive body management
    
//Start coding for x-student management
    function manage_x_std()
    {
        $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
        if($condition)
        {
            $this->form_validation->set_rules('drpBatchName', 'Batch name', 'trim|callback_check_default');
            if ($this->form_validation->run() == FALSE) {
                $data['batchTable']= $this->csdatabase->get_current_batch();
                $data['content']   = 'administration/manage_x_std';
                $this->index($data);
            }
            else
            {
               if($this->csdatabase->make_x_std($this->input->post('drpBatchName')))
               {
                    $data = array(
                        'content'       => 'error/generalMessage',
                        'generalLegend' => '<b style="color:green"> Error : ></b>',
                        'generalMessage'=> "<b style='color:blue'>Successfully Moved.</b>",
                        'leftContent'   => 'registration/login'
                    );
                    $this->index($data);
               }
            }
        }
        else
        {
            $data = array(
                'content'       => 'error/generalMessage',
                'generalLegend' => '<b style="color:green"> Error : ></b>',
                'generalMessage'=> "<b style='color:red'>You are not allowed here.</b>",
                'leftContent'   => 'registration/login'
            );
            $this->index($data);
        }
    }
    //callback function
    function check_default($str)
    {
            if ($str == 'default'){
		$this->form_validation->set_message('check_default', 'The %s not selected');
		return FALSE;
            }
            else{return TRUE;}
     }
//Start coding for x-student management
}
