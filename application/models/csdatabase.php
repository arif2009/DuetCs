<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author Arif
 */
class Csdatabase extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
    }
    function GetUserInfo($userId, $password){
        $array = array('StudentId'=> $userId);
        $query = $this->db->select('Name,Password,Email,Admin')->get_where('members',$array);
            $result = $query->result();
            $dbPassword = $this->encrypt->decode($result[0]->Password);
            if($dbPassword == $password){
                return $result;
            }else{
                return FALSE;
            }
        }
    //It return false if maximun limit is over.
    /*function CheckUploadLimit($userId){
        $sql = "SELECT COUNT(*) AS count FROM project WHERE StudentId = ?";
        $query = $this->db->query($sql, array($userId));
        $row = $query->row();
        if ($row->count == 3) //3 is maximum limit of project
            return FALSE;
        else
            return TRUE;
    }*/
    function SaveProjectHistory($data){
        try{
        $this->db->insert('project',$data);
            return TRUE;
        }  catch (Exception $ex){
            return $ex->getTraceAsString();
        }
    }
    function GetAllProject(){
        $this->db->order_by('UploadDate','desc');
        $query = $this->db->get('project');
        $result = $query->result();
        return $result;
    }
    function get_current_batch()
    {
        /*$this->db->group_by('Batch');
        $query  = $this->db->select('Batch')
                           ->get_where('members', array('Year !=' => 'no'));*/
        
        $sql = "SELECT `Batch`
                FROM (`members`)
                WHERE `Year` != 'no'
                GROUP BY SUBSTRING(Batch FROM 1 FOR length(Batch)-2)+0 LIMIT 1";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0){
             $result = $query->result();
             return($result);
        }
        else
        {
            return FALSE;
        }

    }
    function GetDownloadUrl($attribure, $projectId){
        $query  = $this->db->select($attribure)
                          ->get_where('project',array('ProjectId'=>$projectId));
        $reasult= $query->result();
        $url    = $reasult[0]->$attribure;
        return($url);  
    }
    function create_member() {
        if($this->input->post('resident') == 'yes'){
            $address = 'Hall Name:'.$this->input->post('hallName').', Room No:'.$this->input->post('roomNo');
        }else{
            $address = $this->input->post('presentAddresst');
        }
        try{
            $new_member_insert_data = array(
                'Name'            => $this->input->post('name'),
                'FacultyId'       => $this->input->post('faculty_name'),
                'DepartmentId'    => $this->input->post('drpDepartmentName'),
                'Year'            => $this->input->post('year'),
                'Semister'        => $this->input->post('semister'),
                'StudentId'       => $this->input->post('student_id'),
                'DateOfBirth'     => $this->input->post('date_of_birth'),
                'Sex'             => $this->input->post('sex'),
                'Address'         => $address,
                'ReasonOfInterest'=> $this->input->post('expline_interest'),
                'Email'           => $this->input->post('email_address'),
                'ContractNo'      => $this->input->post('contract_no'),
                'Password'        => $this->encrypt->encode($this->input->post('password')),
                'Batch'           => $this->input->post('batch')
            );
            $insert = $this->db->insert('members',$new_member_insert_data);
            return $insert;
        }  catch (Exception $ex){
            return $ex->getTraceAsString();
        }
    }
    function GetAllFaculty(){
        //Qurey for select all Faculty from faculty table
        $query = $this->db->select('FacultyId, FacultyName')
                          ->get('faculty');
        $table = $query->result();
        return($table);
    }
    function GetAllDepartment(){
        //Qurey for select all department in department table
        $query = $this->db->select('DepartmentId, DepartmentName')
                          ->get_where('department',array('DegreeAward' => 'yes'));
        $table = $query->result();
        return($table);
    }
    function GetAllGroup(){
        //Qurey for select all Groups in group table
        $query = $this->db->select('GroupId, GroupName')
                          ->get('groups');
        $table = $query->result();
        return($table);
    }
    function get_all_executive_member(){
        $sql = "SELECT m.Name, m.StudentId, m.Email, m.ContractNo, ex.GroupId, ex.Responsibility
                FROM members m, executive_body ex
                WHERE m.StudentId = ex.StudentId";
        $query = $this->db->query($sql);
        $table = $query->result();
        return($table);
    }
    function get_all_batch()
    {
        $sql = "SELECT 	Batch
                FROM members
                WHERE Year = 'no'
                GROUP BY Batch";
        $query = $this->db->query($sql);
        $table = $query->result();
        return($table);
    }
    function get_individual_batch($batch)
    {
        $sql = "SELECT 	*
                FROM members
                WHERE Batch = '{$batch}'";
        $query = $this->db->query($sql);
        $table = $query->result();
        return($table);
    }
    function get_member_to_make_admin(){
        $sql = "(SELECT DISTINCT m.Name, m.StudentId, m.Year, m.Semister, m.Admin, d.NickName
                FROM members m, department d
                WHERE m.Admin='yes' AND m.DepartmentId = d.DepartmentId)
                union
                (SELECT DISTINCT m.Name, m.StudentId, m.Year, m.Semister, m.Admin, d.NickName
                FROM members m, department d, executive_body ex
                WHERE m.StudentId = ex.StudentId AND (ex.Responsibility = 'President' OR ex.Responsibility = 'GeneralSecretary' OR ex.Responsibility = 'Finance' OR ex.Responsibility = 'SectionChief') AND m.user_level = 1 AND m.DepartmentId = d.DepartmentId) 
                order by StudentId asc";
        $query = $this->db->query($sql);
        $table = $query->result();
        return($table);
    }
    function get_all_member(){
        $sql = "SELECT m.Name, m.StudentId, m.Email, m.ContractNo, g.GroupId
                FROM members m, groups g, member_group mg
                WHERE m.StudentId = mg.StudentId AND g.GroupId = mg.GroupId AND m.user_level = 1";
        $query = $this->db->query($sql);
        $table = $query->result();
        return($table);
    }
    function GetAllYear(){
        //Qyrey for select all year in entry table
        $this->db->group_by('entry_year');
        $this->db->order_by('entry_year','desc');
        $this->db->select('entry_year');
        $query = $this->db->get('entry');
        $table = $query->result();
        return($table);
    }
    function GetAllMonth($year){
        //Qurey for select all month per year in entry table
        $this->db->where('entry_year',$year);
        $this->db->order_by('entry_id','desc');
        $this->db->group_by('entry_month');
        $this->db->select('entry_month');
        $query = $this->db->get('entry');
        $table = $query->result();
        return($table);
    }
    function GetAllHeading($month,$year){
        //Qurey for select all heading 
        $this->db->where('entry_month',$month);
        $this->db->where('entry_year',$year);
        $this->db->select('entry_id, entry_name');
        $query = $this->db->get('entry');
        $table = $query->result();
        return($table);
    }
    function GetBlog($id){
        //Qurey for select heading and content
        $this->db->where('entry_id',$id);
        $this->db->select();
        $query = $this->db->get('entry');
        $table = $query->result();
        return($table);
    }
    function GetComment($id){
        //Qurey for select heading and content
        $this->db->where('entry_id',$id);
        $this->db->order_by('comment_id','desc');
        $query = $this->db->get('comment');
        $table = $query->result();
        $numberOfComment = $query->num_rows();
        return(array($numberOfComment,$table));
    }
    function AddNewComment($id)
    {
        $session_name = $this->session->userdata('userName');
        $new_comment_insert= array(
            'entry_id'    => $id,
            'comment_name'=> $session_name,
            'user_id'     => $this->session->userdata('userId'), 
            'comment_body'=> $this->input->post('comment')
        );
        $insert = $this->db->insert('comment',$new_comment_insert);
        return $insert;
    }
    function create_post(){
        $name = $this->session->userdata('userName');
        $new_post_insert = array(
            'entry_name'       => $this->input->post('entry_name'),
            'entry_body'       => $this->input->post('entry_body'),
            'entry_year'       => date('Y'),
            'entry_month'      => date('M'),
            'entry_author_name'=> $name,
            'user_id'          => $this->session->userdata('userId')
        );
        $this->db->insert('entry',$new_post_insert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function update_post(){
        $updatedData = array(
            'entry_name'       => $this->input->post('entry_name'),
            'entry_body'       => $this->input->post('entry_body'),
            'entry_year'       => $this->input->post('entry_year'),
            'entry_month'      => $this->input->post('entry_month')
        );
        $this->db->where('entry_id', $this->input->post('entry_id')); 
        $result = $this->db->update('entry',$updatedData);
        return $result;
    }
    function GetAllPost(){
        $this->db->order_by('entry_id','desc');
        $this->db->select();
        $query = $this->db->get('entry');
        $table = $query->result();
        return($table);
    }
    function CountComment($entry_id){
       $this->db->select('count(entry_id) as number')
                ->where('entry_id',$entry_id);
        $query = $this->db->get('comment'); 
        $counterTable = $query->result();
        return($counterTable[0]->number);
    }
    ////News
    function GetNews(){
        //This function for get news
        $this->db->order_by('id','desc');
        $this->db->select('id,Title')
                ->limit('10');
        $query = $this->db->get('notice');
        $table = $query->result();
        return($table);
    }
    function GetNewsContent($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('notice');
        if($query->num_rows() >0)
        {
            $table = $query->result();
            return($table);
        }
        else
        {
            return FALSE;
        }
    }
    function GetAllNotice(){
        $this->db->order_by('id','desc');
        $query = $this->db->get('notice');
        $table = $query->result();
        return($table);
    }
    function CreateNotice(){
        $new_notice_insert = array(
            'Title'  => $this->input->post('entry_name'),
            'Description' => str_replace("<img", "<img width='510' height='400'", $this->input->post('entry_body')),
        );
        $this->db->insert('notice',$new_notice_insert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function UpdateNotice(){
        $updatedData = array(
            'Title'       => $this->input->post('entry_name'),
            'Description' => $this->input->post('entry_body')
        );
        $this->db->where('Id', $this->input->post('news_id')); 
        $result = $this->db->update('notice',$updatedData);
        return $result;
    }
    ////News
    
    //Function for Administration
    function requested_student_list(){
        $sql    = 'SELECT m.Name, m.StudentId, d.NickName, m.Year, m.Semister
                   FROM members m, department d
                   WHERE m.user_level = 0 AND m.DepartmentId = d.DepartmentId';
        $query  = $this->db->query($sql);
        $result = $query->result();
        return($result);
    }
    function get_field_of_interest($std_id){
        $sql = "SELECT mg.GroupId, g.GroupName
                FROM groups g, member_group mg
                WHERE mg.StudentId = '{$std_id}' and mg.GroupId = g.GroupId";
        $query = $this->db->query($sql);
        $result= $query->result();
        return($result);
    }
    function view_details($std_id){
        $sql = "SELECT m.Name, f.FacultyName 'Faculty Name', d.DepartmentName 'Department Name', m.Year, m.Semister, m.StudentId, m.DateOfBirth 'Date Of Birth', m.Sex, m.Address, m.ReasonOfInterest 'Reason Of Interest', m.Email, m.ContractNo 'Contact Number'
                FROM members m, department d, faculty f
                WHERE m.StudentId = '{$std_id}' and d.DepartmentId = m.DepartmentId and f.FacultyId = m.FacultyId";
        $query = $this->db->query($sql);
        $result = $query->result();
        return($result);
    }
    function accept_executive($std_id){
        try{
            $data = array(
                'ExecutiveBody'=> 'yes',
                'user_level'   => 1
            );
            $this->db->where('StudentId', $std_id);
            $this->db->update('members', $data);
            return TRUE;
        }
        catch (Exception $ex)
        {
            echo $ex->getTraceAsString();
        }
        
    }
    function accept_general($std_id){
        try{
            $this->db->where('StudentId', $std_id);
            $this->db->update('members', array('user_level'   => 1));
            return TRUE;
        }
        catch (Exception $ex)
        {
            echo $ex->getTraceAsString();
        }
    }
    function remove_stdunt_from_group($std_id,$group_id){
        try
        {
            $this->db->delete('member_group', array('StudentId' => $std_id,'GroupId'=>$group_id));
            return TRUE;
        }
        catch (Exception $ex)
        {
            echo $ex->getTraceAsString();
        }
    }
    function RemoveMemner($memInfo){
        try{
            $this->db->delete('executive_body',$memInfo);
            return TRUE;
        }
        catch (Exception $ex){
            return $ex->getTraceAsString();
        }
    }
    function delete_info($std_id){
        try
        {
            $tables = array('member_group', 'members');
            $this->db->where(array('StudentId' => $std_id));
            $this->db->delete($tables);
            return TRUE;
        }
        catch (Exception $ex)
        {
            echo $ex->getTraceAsString();
        }
    }
    function add_stdunt_to_group($std_id,$group_id){
        try
        {
            $this->db->insert('member_group', array('StudentId' => $std_id,'GroupId'=>$group_id));
            return TRUE;
        }
        catch (Exception $ex)
        {
            echo $ex->getTraceAsString();
        }
    }
    function update_admin_info($std_id, $data){
         try{
            $this->db->where('StudentId', $std_id);
            $this->db->update('members', array('Admin' => $data));
            return TRUE;
        }
        catch (Exception $ex)
        {
            echo $ex->getTraceAsString();
        }
    }
    function make_x_std($batch){
        try {
            $data = array(
                'Year'    => 'no',
                'Semister'=> 'no',
                'Admin'   => 'no'
                );
            $this->db->where('Batch', $batch);
            $this->db->update('members', $data); 
            return TRUE;
        }
        catch (Exception $ex)
        {
            echo $ex->getTraceAsString();
        }
    }
    function member_exist($id)
    {
        $query = $this->db->query("SELECT * FROM members WHERE StudentId = '{$id}' AND user_level = 1");
        if ($query->num_rows() > 0)
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
    //Start Function for update student information
    function get_std_info_for_update($std_id){
        $sql = "SELECT Name, FacultyId, DepartmentId, Year, Semister, Batch, DateOfBirth, ContractNo, Email
                FROM members
                WHERE StudentId = ?";
        $query = $this->db->query($sql,array($std_id));
        $table = $query->result();
        return($table);
    }
    function update_member_info($std_id)
    {
        if($this->input->post('resident') == 'yes'){
            $address = 'Hall Name:'.$this->input->post('hallName').', Room No:'.$this->input->post('roomNo');
        }else{
            $address = $this->input->post('presentAddresst');
        }
        
        try
        {
            $member_data = array(
                'Name'            => $this->input->post('name'),
                'FacultyId'       => $this->input->post('faculty_name'),
                'DepartmentId'    => $this->input->post('drpDepartmentName'),
                'Year'            => $this->input->post('year'),
                'Semister'        => $this->input->post('semister'),
                'Batch'           => $this->input->post('batch'),
                'DateOfBirth'     => $this->input->post('date_of_birth'),
                'Address'         => $address,
                'ContractNo'      => $this->input->post('contract_no'),
                'Email'           => $this->input->post('email_address'),
                'Password'        => $this->encrypt->encode($this->input->post('password1'))
             );
            $this->db->where('StudentId',$std_id);
            $this->db->update('members',$member_data);
            return TRUE;
        }
        catch (Exception $ex)
        {
            echo $ex->getTraceAsString();
        }
    }
    // End Function for update student information
    
    //If direct request return true
    function is_direct_request_for_post($post_id)
    {
        $query = $this->db->select('user_id')
                          ->get_where('entry',array('entry_id'=>$post_id));
        if($query->num_rows() > 0)
        {
            $result = $query->result();
            if($result[0]->user_id == $this->session->userdata('userId'))
            {
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
    
    //If direct request return true
    function is_direct_request_for_comm($comment_id)
    {
        $query = $this->db->select('user_id')
                          ->get_where('comment',array('comment_id'=>$comment_id));
        if($query->num_rows() > 0)
        {
            $result = $query->result();
            if($result[0]->user_id == $this->session->userdata('userId'))
            {
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
