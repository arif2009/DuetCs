<script type="text/javascript">
    //Confirm message
    $(function(){
        $('#move').click(function(){
            var answer = confirm("Are you sure ?")
            if (answer){
                    return true;
            }
            else{
                return false;
            }
        });
    });
</script>
<div id="stylized" class="myform">
    <?php echo form_open('administration/manage_x_std',array('id'=>'frmXstd','name'=>'frmXstd'));?>
    <h1>X-student Management</h1>
    <p>Move course completed student to X-student.</p>
     <?php
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $error = '<ul class="errors">';
        $error.= validation_errors();
        $error.= '</ul>';
        echo $error;
    ?>
    <label>Batch
    <span class="small">Select a batch to move</span>
    </label>
    <?php
        $options = array('default'  => 'Select Batch');
        if(is_array($batchTable))
            $options[$batchTable[0]->Batch] = $batchTable[0]->Batch;
        
        echo form_dropdown('drpBatchName', $options, set_value('drpBatchName', 'default'));
    ?>
    
    <span class="push_3">
    <button type="submit" id="move">Move</button>
    </span>
    
    <?php echo form_close();?>
</div>
