<script type="text/javascript">
    $(function() {
        $("#date_of_birth").datepicker({ changeMonth: true, changeYear: true, yearRange: "-40:-15",dateFormat: "yy-mm-dd" });
    });
</script>
<div id="registrationContent">
    <?php
    $this->form_validation->set_error_delimiters('<li>', '</li>');
    $error = '<ul class="errors">';
    $error.= validation_errors();
    $error.= '</ul>';
    echo $error;
    ?>

    <?php echo form_open('welcome/create_member',array('name'=>'frmRegistration','id'=>'frmRegistration'));?>
        <?php
        $CI = &get_instance();
        $CI->load->model('csdatabase');
        ?>
        <table width="100%" class="outter">
            <tr>
        <td>
            <table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
                <tr height="40px">
                    <td colspan="5" class="formHeading">Register - Create Account [Only for DUET Students]</td>
                </tr>
                <tr>
                    <td colspan="5" class="note" bgcolor="#E0F0E8" height="25px" style="vertical-align:middle">Field marked with <span style="color:#FF0000">*</span> are compulsory fields
                    </td>
                </tr>
                <tr height="10px">
                    <td colspan="5"></td>
                </tr>
            <tr>
                <td align="right" bgcolor="#E0F0E8" width="32%"><span style="color:#FF0000">*</span>Name </td>
                <td colspan="4" width="68%"><?php echo form_input(array('name'=> 'name','value'=>set_value('name'),'maxlength'=> '50','style'=> 'width:99%','class'=> 'input'));?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Faculty </td>
                <?php
                $options = array('default'  => '*********Select Faculty*********');
                    $facultyTable = $CI->csdatabase->GetAllFaculty();
                    foreach ($facultyTable as $row) {
                        $options[$row->FacultyId] = $row->FacultyName;
                    }
                $js = 'id="faculty_name" class="input"';
                ?>
                <td colspan="4"><?php echo form_dropdown('faculty_name', $options, set_value('faculty_name', 'default'),$js);?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Department </td>
                <?php
                $options = array('default'  => '*******Select Department*******');
                    $departmentTable = $CI->csdatabase->GetAllDepartment();
                    foreach ($departmentTable as $row) {
                        $options[$row->DepartmentId] = $row->DepartmentName;
                    }
                $js = 'id="drpDepartmentName" class="input"';
                ?>
                <td colspan="4"><?php echo form_dropdown('drpDepartmentName', $options, set_value('drpDepartmentName', 'default'),$js);?></td>
            </tr>
        
            <tr>
                <td width="32%" align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Year </td>
                    <?php
                    $options = array('1st'=> 'First',
                                    '2nd'=> 'Second',
                                    '3rd'=> 'Third',
                                    '4th'=> 'Fourth',
                                    'no'=> 'X-Student');
                    $js = 'id="year" class="input"';
                    ?>
                <td width="36%"><?php echo form_dropdown('year', $options, set_value('year', '1st'),$js);?></td>
                <td width="12%" align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Semister </td>
                <?php
                $options = array('1st'=> 'First',
                                '2nd'=> 'Second',
                                'no'=> 'X-Student');
                $js = 'id="semister" class="input"';
                ?>
                <td width="20%" colspan="2"><?php echo form_dropdown('semister', $options, set_value('semister', '2nd'),$js);?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Student Id </td>
                <td><?php echo form_input('student_id', set_value('student_id'),'style="width:98%" class="input"');?></td>
                <td width="12%" align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Batch </td>
                <?php
                $options = array('1st'=> '1st',
                                '2nd'=> '2nd',
                                '3rd'=> '3rd',
                                '4th'=> '4th',
                                '5th'=> '5th',
                                '6th'=> '6th',
                                '7th'=> '7th',
                                '8th'=> '8th',
                                '9th'=> '9th',
                                '10th'=> '10th',
                                '11th'=> '11th',
                                '12th'=> '12th',
                                '13th'=> '13th',
                                '14th'=> '14th',
                                '15th'=> '15th',
                                '16th'=> '16th',
                                '17th'=> '17th',
                                '18th'=> '18th',
                                '19th'=> '19th',
                                '20th'=> '20th');
                $js = 'id="batch" class="input"';
                ?>
                <td colspan="2"><?php echo form_dropdown('batch', $options, set_value('batch', '9th'),$js);?></td>
            </tr>
        
            <tr>
                <td width="32%" align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Date Of Birth </td>
                <?php
                $data = array(
                    'name'        => 'date_of_birth',
                    'id'          => 'date_of_birth',
                    'value'       => set_value('date_of_birth'),
                    'style'       => 'width:99%',
                    'class'       => 'input'
                );
                ?>
                <td width="68%" colspan="4"><?php echo form_input($data);?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Sex </td>
                <td colspan="4"><?php echo form_radio('sex','Mail',TRUE);?>Male &nbsp;&nbsp;&nbsp;&nbsp; <?php echo form_radio('sex','Female');?>Female</td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Resident </td>
                <td colspan="4"><?php echo form_radio(array('id' => 'resident','class'=> 'input', 'name' => 'resident', 'value' => 'yes'));?>Yes &nbsp;&nbsp;&nbsp;&nbsp; <?php echo form_radio(array('id' => 'resident', 'class'=> 'input', 'name' => 'resident', 'value' => 'no'));?>No</td>
            </tr>
        
            <tr id="address"></tr>
        
            <tr>
                <td width="32%" align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Field Of Interest (Select any Two Field) </td>
                <td width="68%" colspan="4">
                <?php
                $groupTable = $CI->csdatabase->GetAllGroup();
                $checked = TRUE;
                foreach ($groupTable as $row) {
                    $chkProperties = array( 
                        'name'   => 'chkGroups[]',
                        'id'     => 'chkGroups',
                        'value'  => $row->GroupId,
                        'onChange'=> 'check_checked_radio()',
                        'checked'=> $checked,
                        'class'=> 'input'
                    );
                    echo form_checkbox($chkProperties).nbs().$row->GroupName.br();
                    $checked = FALSE;
                }
                ?>
                </td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Why you are choice this group(Explain maximum 250 character) </td>
                <?php
                $data = array(
                    'name' => 'expline_interest',
                    'id'   => 'expline_interest',
                    'value'=> set_value('expline_interest'),
                    'rows' => 5,
                    'cols' => 45,
                    'style'=> 'width:99%',
                    'class'=> 'input'
                );
                ?>
                <td colspan="4"><?php echo form_textarea($data);?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Contact No </td>
                <td colspan="4"><?php echo form_input('contract_no', set_value('contract_no'),'style="width:99%" class="input"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Email </td>
                <td colspan="4"><?php echo form_input('email_address', set_value('email_address'),'style="width:99%" id="email_address" class="input"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Confirm Email </td>
                <td colspan="4"><?php echo form_input('confirm_email_address', set_value('confirm_email_address'),'style="width:99%" class="input"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Password </td>
                <td colspan="4"><?php echo form_password('password', set_value('password'),'style="width:99%" class="input"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Re-Enter Password </td>
                <td colspan="4"><?php echo form_password('password2', set_value('password2'),'style="width:99%" class="input"');?></td>
            </tr>
        
            <tr>
                <?php
                // Capta code
                $data = array(
                    'captcha_time'=> $cap['time'], 
                    'ip_address'  => $this->input->ip_address(),
                    'word'        => $cap['word']
                );
                $query = $this->db->insert_string('captcha',$data);
                $this->db->query($query);
                ?>
                <td width="100%" colspan=5 align="center"><?php echo $cap['image'];?></td>
            </tr>
        
            <tr>
                <td colspan="5" align="center"><span style="color:#FF0000">*</span>Submit the letter(Not Case sensitive) see you Avobe</td>
            </tr>
        
            <tr>
                <td colspan="5" align="center"><?php echo form_input('captcha');?></td>
            </tr>
            
            <tr>
                <td width="32%"></td>
                <td width="68%" colspan="4"><?php echo br().form_checkbox(array('id' => 'agree', 'name' => 'agree', 'class'=> 'input', 'value' => 'agree')).' <b>I agree with this '.anchor(base_url("images/rules.html"), 'Rules & Regulation</b>', 'target="_blank"');?></td>
            </tr>
        
            <tr>
                <td></td>
                <td height="30" colspan="4">
                        <?php
                        $properties = array(
                            'name'    => 'createAcc',
                            'id'      => 'createAcc',
                            'value'   => 'Continue >>',
                            'disabled'=> 'disabled',
                            'class'   => 'btnbg'
                        );
                        echo br().form_submit($properties).nbs(2);
                        echo form_reset(array('name'=>'reset','id'=>'reset','value'=> 'Reset','class'=>'btnReset','OnClick'=>'this.form.reset();'));
                        ?>
                </td>
            </tr>
        </table>
      </td>
    </tr>
</table>
    <?=form_close()?>
</div>
<!--Ajax-->
<?php $this->load->view('registration/script');?>