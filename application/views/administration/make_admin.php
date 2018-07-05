<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.ext.js");?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".box").tablify("box");
});
</script>
<div>
    <table class="box" width="100%">
        <tr><th width="50%">Executive Body</th><th width="50%">Action</th></tr>
        <?php
            foreach ($executive_body_student as $rows) 
            {
                $std_info = $rows->Name.'('.$rows->StudentId.')'.br().'Dept: '.$rows->NickName.br().'Year/Semister: '.$rows->Year.'/'.$rows->Semister.br().anchor('administration/view_details/'.$rows->StudentId, 'View Details');
                if($rows->Admin == 'yes')
                {
                    $data = array('<span style="color:red">remove admin</span>','no');
                }
                else
                {
                    $data = array('make admin','yes');
                }
                $row = '<tr>';
                $row.= "<td>$std_info</td><td>".anchor('administration/manage_admin/'.$rows->StudentId.'/'.$data[1], $data[0]).'</td>';
                $row.= '</tr>';
                echo $row;
            }
        ?>
   </table>
</div>
