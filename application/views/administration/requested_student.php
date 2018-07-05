<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.ext.js");?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".box").tablify("box");
});
function group_manipulation(obj,std_id){
    
    var form_data = {
        std_id   : std_id,
        group_id : $(obj).val()	
    };
    if(!$(obj).is(":checked"))
    {
       form_data['ajax'] = '1';
       $.ajax({
           url: "<?php echo site_url('administration/group_manipulation');?>",
           type: 'POST',
           data: form_data,
           success: function() 
           {  
               alert('This student removed from "'+$(obj).attr('name')+'" group.');//To get id use this.id
           }
       });
    }
    else
    {
       form_data['ajax'] = '2';
       $.ajax({
           url: "<?php echo site_url('administration/group_manipulation');?>",
           type: 'POST',
           data: form_data,
           success: function() 
           {  
               alert('This student added to the "'+$(obj).attr('name')+'" group.');//To get id use this.id
           }
       });
    }
}
</script>
<div>
    <table class="box" width="100%">
        <tr><th width="40%">Requested Student</th><th width="30%">Interested Group</th><th width="20%">Accept as general member</th><th width="10%">Reject</th></tr>
        <?php
            $CI = &get_instance();
            foreach ($std_list as $rows) 
            {
                $groupTable = $CI->csdatabase->get_field_of_interest($rows->StudentId);
                $checked_field = '';
                foreach ($groupTable as $row) 
                {
                    $chkProperties = array( 
                        'name'   => $row->GroupName,
                        'id'     => $rows->StudentId,
                        'value'  => $row->GroupId,
                        'onClick'=>"group_manipulation(this,'{$rows->StudentId}')",
                        'checked'=> TRUE
                    );
                    $checked_field.= form_checkbox($chkProperties).nbs().$row->GroupName.br(2);
                }
                $std_info = $rows->Name.'('.$rows->StudentId.')'.br().'Dept: '.$rows->NickName.br().'Year/Semister: '.$rows->Year.'/'.$rows->Semister.br().anchor('administration/view_details/'.$rows->StudentId, 'View Details');
                $row = '<tr>';
                $row.= "<td>$std_info</td><td>".$checked_field.'</td><td>'.anchor('administration/accept_general/'.$rows->StudentId, 'accept').'</td><td>'.anchor('administration/reject/'.$rows->StudentId, 'deny').'</td>';
                $row.= '</tr>';
                echo $row;
            }
        ?>
   </table>
</div>