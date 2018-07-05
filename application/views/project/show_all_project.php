<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.ext.js");?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".box").tablify("box");
});
</script>
<div>
    <table class="box" width="100%">
        <tr><th width="40%">Project Title</th><th width="20%">Project Documentation</th><th width="20%">Project Code</th><th width="20%">Uploaded Date</th></tr>
        <?php
            foreach ($projectTable as $rows) {
                $row = '<tr>';
                $row.= "<td>$rows->ProjectName</td><td>".anchor($rows->ProjectDocumentation, 'Download Documentation').'</td><td>'.anchor($rows->ProjectCode, 'Download Code').'</td><td>'.$rows->UploadDate.'</td>';
                $row.= '</tr>';
                echo $row;
            }
        ?>
   </table>
</div>