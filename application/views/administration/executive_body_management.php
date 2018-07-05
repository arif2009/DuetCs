<script type="text/javascript">
    //Hide Section on page lode
    $(function(){
        $("span#section").css("display", "none");
    });
    
    //Hide or Show section conditionally
    $(function(){
        $("select[name='position']").bind('change click',function(){
            var group = $(this).val();
            if(group == 'SectionChief' || group == 'SectionMember'){
                $("span#section").removeAttr('style');
            }
            else
            {
                $("span#section").css("display", "none");
            }
        });
    });
    
    //Different form action submit different page according to different submit button
    $(function(){
        $('button').click(function(e){
            if(e.target.name == 'add'){
                $('#frmExec').attr('action', '<?php echo base_url("administration/select_exec_body");?>');
            }
            else if(e.target.name == 'remove'){
                $('#frmExec').attr('action', '<?php echo base_url("administration/remove");?>');
                var answer = confirm("Are you sure ?");
                if(answer){
                    return true;
                }else{
                    return false;
                }
            }
            else if(e.target.name == 'removeAll'){
                var answer = confirm("Are you sure ?");
                if (answer){
                        window.location = "<?php echo base_url("administration/remove_all");?>";
                }
                else{
                    return false;
                }
            }
        });
    });
</script>
<div id="stylized" class="myform">
    <?php echo form_open('administration/select_exec_body',array('id'=>'frmExec','name'=>'frmExec'));?>
    <h1>Executive member selection</h1>
    <p>This is the main society family, they are leading society.</p>
    <?php
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $errors = '<ul class="errors">';
        $errors.= "<li>{$error}</li>";
        $errors.= validation_errors();
        $errors.= '</ul>';
        echo $errors;
    ?>
    <label>Std. Id
    <span class="small">Student Id of a member</span>
    </label>
    <?php echo form_input('stdId', set_value('stdId'));?>

    <label>Position
    <span class="small">Responsibility of this student</span>
    </label>
    <?php
         $options = array(
             'President'          => 'President',
             'VicePresident'      => 'Vice President',
             'GeneralSecretary'   => 'General Secretary',
             'AssGeneralSecretary'=> 'Assistant General Secretary',
             'Finance'            => 'Finance Director',
             'AFinance'           => 'Additional Finance Director',
             'SectionChief'       => 'Section Chief',
             'SectionMember'      => 'Section Member'
         );
         echo form_dropdown('position', $options, set_value('position', 'President'));
    ?>
    
    <span id="section">
    <label>Section
    <span class="small">Member of group</span>
    </label>
    <?php
         $options = array(
             'G01' => 'Programming & Algorithms',
             'G02' => 'Application & Project',
             'G03' => 'Network & Communication',
             'G04' => 'Multimedia & Gaming',
             'G05' => 'Co-Curricular activities',
             'G06' => 'Li-aison & Publications'
         );
         echo form_dropdown('section', $options, set_value('section', 'G01'));
    ?>
    </span>
    
    <span class="push_2">
    <button type="submit" name="add" value="add">Add</button>
    <button type="submit" name="remove" value="remove">Remove</button>
    <button type="reset" name="removeAll" value="remove_all">Remove All</button>
    </span>
    
    <?php echo form_close();?>
</div>