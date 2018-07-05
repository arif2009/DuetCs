<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.ext.js");?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".box").tablify("box");
});
</script>
<div>
    <table class="box" width="100%">
        <tr><th width="50%">Previous Student Batch</th><th width="50%">Action</th></tr>
        <?php
            foreach ($batch_table as $rows) 
            {
                $row = '<tr>';
                $row.= "<td>{$rows->Batch} Batch</td><td>".anchor('groups/show_ind_x_std/'.$rows->Batch, 'View','title="View all members"').'</td>';
                $row.= '</tr>';
                echo $row;
            }
        ?>
   </table>
</div>