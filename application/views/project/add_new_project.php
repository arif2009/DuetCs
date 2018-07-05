<script type="text/javascript" src="<?=base_url("script/jquery.tablify.js")?>"></script>
<script type="text/javascript" src="<?=base_url("script/jquery.tablify.ext.js")?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".box").tablify("box");
});
var ray={
	ajax:function(st){
		this.show('load');
                $('#save').attr('disabled', 'disabled');
	},
	show:function(animation){
		this.getID(animation).style.display='';
	},
	getID:function(animation){
		return document.getElementById(animation);
	}
}
</script>
<style type="text/css">
#load{
    position:absolute;
    z-index:1;
    margin-top:-150px;
    margin-left:-150px;
    top:60%;
    left:60%;
}
</style>
<div class="addNewProject">
<!--    For Please wait-->
    <div id="load" style="display:none;"><img src="<?=base_url("images/animated_progress_bar.gif")?>" alt="Loading... Please wait" /></div>
    <table class="box">
        <tr>
            <td>Rules for upload :</td>
            <td>
                1. You must enter "Project Title,Documentation & Code".<br/>
                2. Project Documentation must be pdf file.<br/>
                3. Project code must be zip file.<br/>
                4. Each project documentation maximum size 100KB.<br/>
                5. And each project code maximum size 1MB.
            </td>
        </tr>
        <tr>
            <td colspan="2">
              <?php
                   $this->form_validation->set_error_delimiters('<li>','</li>');
                   $error  = '<ul class="errors" style="text-align: center">';
                   $error.= validation_errors();
                   $error.= (empty($field_errors)?'':$field_errors);
                   $error.= '</ul>'; 
                   echo $error;
              ?>
            </td>
        </tr>
        <tr>
            <td>Project Title :<span style="color:red">*</span></td>
            <?php
            $attributes = array(
                'id'      => 'projectUpload',
                'name'    => 'projectUpload',
                'method'  => 'post',
                'onsubmit'=> 'return ray.ajax()'
            );
            echo form_open_multipart('welcome/add_a_new_project',$attributes);
            $data = array(
                'name'      => 'projectTitle',
                'id'        => 'projectTitle',                        
                'value'     => set_value('projectTitle'),
                'maxlength' => '200', //specify the maximum number of characters allowed in the <input> element
                'size'      => '54', //Specifies the width of an <input> element, in characters.
                'style'       => 'background-color: #DDDDDD'
            );
            ?>
            <td><?php echo form_input($data);?></td>
        </tr>
        <tr>
            <td>Project Documentation :<span style="color:red">*</span></td>
            <td><?php echo form_upload(array('name' => 'ProjectDoc','id' => 'ProjectDoc'));?></td>
        </tr>
        <tr>
            <td>Project Code :<span style="color:red">*</span></td>
            <td><?php echo form_upload(array('name' => 'ProjectCode','id' => 'ProjectCode'));?></td>
        </tr>
        <tr>
            <td colspan="2">
                <?php
                $save = array(
                    'name'        => 'save',
                    'id'          => 'save',
                    'value'       => 'Save',
                    'class'       => 'submit'
                );
                echo form_submit($save);
                echo form_close();
                ?>
            </td>
        </tr>
   </table>
</div>
