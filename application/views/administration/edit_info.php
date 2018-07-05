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

    <?php echo form_open('administration/edit_info',array('name'=>'frmRegistration','id'=>'frmRegistration'));?>
        <?php
        $CI = &get_instance();
        $CI->load->model('csdatabase');
        ?>
        <table width="100%" class="outter">
            <tr>
        <td>
         <table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
            <tr height="40px">
                <td colspan="4" class="formHeading">Edit Your Informatio</td>
            </tr>
            
            <tr>
                <td colspan="4" class="note" bgcolor="#E0F0E8" height="25px" style="vertical-align:middle">Field marked with <span style="color:#FF0000">*</span> are compulsory fields</td>
            </tr>
            <tr height="10px">
                <td colspan="4"></td>
            </tr>
            
            <tr>
                <td align="right" bgcolor="#E0F0E8" width="30%"><span style="color:#FF0000">*</span>Name</td>
                <td colspan="3" width="70%"><?php echo form_input('name', set_value('name',$std_data[0]->Name),'style="width:99%"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Faculty</td>
                <?php
                $options = array('default'  => 'Select Faculty');
                    $facultyTable = $CI->csdatabase->GetAllFaculty();
                    foreach ($facultyTable as $row) {
                        $options[$row->FacultyId] = $row->FacultyName;
                    }
                $js = 'id="faculty_name"';
                ?>
                <td colspan="3"><?php echo form_dropdown('faculty_name', $options, set_value('faculty_name', $std_data[0]->FacultyId),$js);?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Department</td>
                <?php
                $options = array('default'  => 'Select Department');
                    $departmentTable = $CI->csdatabase->GetAllDepartment();
                    foreach ($departmentTable as $row) {
                        $options[$row->DepartmentId] = $row->DepartmentName;
                    }
                $js = 'id="drpDepartmentName"';
                ?>
                <td colspan="3"><?php echo form_dropdown('drpDepartmentName', $options, set_value('drpDepartmentName', $std_data[0]->DepartmentId),$js);?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8" width="30%"><span style="color:#FF0000">*</span>Year</td>
                <?php
                $options = array('1st'=> 'First',
                                '2nd'=> 'Second',
                                '3rd'=> 'Third',
                                '4th'=> 'Fourth',
                                'no'=> 'X-Student');
                $js = 'id="year"';
                ?>
                <td width="20%"><?php echo form_dropdown('year', $options, set_value('year', $std_data[0]->Year),$js);?></td>
                <td align="right" bgcolor="#E0F0E8" width="20%"><span style="color:#FF0000">*</span>Semister</td>
                <?php
                $options = array('1st'=> 'First',
                                '2nd'=> 'Second',
                                'no'=> 'X-Student');
                $js = 'id="semister"';
                ?>
                <td width="30%"><?php echo form_dropdown('semister', $options, set_value('semister', $std_data[0]->Semister),$js);?></td>
            </tr>
            
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Batch </td>
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
                <td colspan="3"><?php echo form_dropdown('batch', $options, set_value('batch', $std_data[0]->Batch),$js);?></td>
            </tr>
            
            <tr>
                <td align="right" bgcolor="#E0F0E8" width="30%"><span style="color:#FF0000">*</span>Date Of Birth</td>
                <?php
                $data = array(
                    'name'        => 'date_of_birth',
                    'id'          => 'date_of_birth',
                    'value'       => set_value('date_of_birth',$std_data[0]->DateOfBirth),
                    'style'       => 'width:99%'
                );
                ?>
                <td colspan="3" width="70%"><?php echo form_input($data);?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8" width="30%"><span style="color:#FF0000">*</span>Resident</td>
                <td width="35%"><?php echo form_radio(array('id' => 'resident', 'name' => 'resident', 'value' => 'yes')).' Yes';?></td>
                <td width="35%" colspan="2"><?php echo form_radio(array('id' => 'resident', 'name' => 'resident', 'value' => 'no')).' No';?></td>
            </tr>
        
            <tr id="address"></tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8" width="30%"><span style="color:#FF0000">*</span>Contact No</td>
                <td colspan="3" width="70%"><?php echo form_input('contract_no', set_value('contract_no',$std_data[0]->ContractNo),'style="width:99%"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Email</td>
                <td colspan="3"><?php echo form_input('email_address', set_value('email_address',$std_data[0]->Email),'style="width:99%",id="email_address"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Confirm Email</td>
                <td colspan="3"><?php echo form_input('confirm_email_address', set_value('confirm_email_address'),'style="width:99%"');?></td>
            </tr>
            
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Current Password</td>
                <td colspan="3"><?php echo form_password('password', set_value('password'),'style="width:99%"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>New Password</td>
                <td colspan="3"><?php echo form_password('password1', set_value('password1'),'style="width:99%"');?></td>
            </tr>
        
            <tr>
                <td align="right" bgcolor="#E0F0E8"><span style="color:#FF0000">*</span>Confirm Password</td>
                <td colspan="3"><?php echo form_password('password2', set_value('password2'),'style="width:99%"');?></td>
            </tr>
        
            <tr>
                <?php
                $properties = array(
                    'name'    => 'update',
                    'id'      => 'update',
                    'value'   => 'Update'
                );
                ?>
                <td colspan="4" align="right"><?php echo form_submit($properties);?></td>
            </tr>
         </table>
        </td>
       </tr>
        </table>
    <?=form_close()?>
</div>
<!--Ajax-->
<?php $this->load->view('registration/edit_info_script');?>
