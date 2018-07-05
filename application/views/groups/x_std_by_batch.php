<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("script/jquery.tablify.ext.js");?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".box").tablify("box");
});
</script>
<div>
    <table class="box" width="100%">
        <tr><th width="40%">Name</th><th width="40%">E-Mail</th><th width="20%">Contact No</th></tr>
        <?php
            foreach ($batch_std as $rows) 
            {
                $row = '<tr>';
                $row.= "<td>{$rows->Name}</td><td>{$rows->Email}</td><td>{$rows->ContractNo}</td>";
                $row.= '</tr>';
                echo $row;
            }
        ?>
   </table>
    <div style="text-align: center"><a href="javascript:window.history.go(-1);"><< Go back</a></div>
</div>