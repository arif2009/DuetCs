<?php
$head = '<script type="text/javascript" src='.base_url("reach_text_box/htmlbox.colors.js").'></script>';// Rich text box
$head .= '<script type="text/javascript" src='.base_url("reach_text_box/htmlbox.full.js").'></script>';// Rich text box
$head .= '<script type="text/javascript" src='.base_url("reach_text_box/htmlbox.syntax.js").'></script>';// Rich text box
$head .= '<script type="text/javascript" src='.base_url("reach_text_box/htmlbox.undoredomanager.js").'></script>';// Rich text box
$head .= '<script type="text/javascript" src='.base_url("reach_text_box/xhtml.js").'></script>';// Rich text box
echo $head;
?>
<script type="text/javascript">
    $(function(){
        $('#entry_body').htmlbox({
            toolbars:[
                [
                // Bold, Italic, Underline, Strikethrough, Sup, Sub
		"separator","bold","italic","underline","strike","sup","sub",
		// Undo, Redo
		"separator","undo","redo",
		// Left, Right, Center, Justify
		"separator","justify","left","center","right",
		// Ordered List, Unordered List, Indent, Outdent
		"separator","ol","ul","indent","outdent",
		// Hyperlink, Remove Hyperlink, Image
		"separator","link","unlink","image"
		],
		[
                // Formats, Font size, Font family, Font color, Font, Background
                "separator","highlight","fontcolor","fontsize","fontfamily",
                // Styles, Source code syntax buttons
		"separator","syntax"
		],
		[
                // Show code
		"separator","code",
		//Strip tags
		"separator","removeformat","hr","paragraph",
		]
	],
            skin:"blue",
            about:true
        },<?="'".base_url()."'"?>);
    });
    //Loading
    function showLoader(){
         $('.please-wait').fadeIn(200);
    }
</script>
<div style=" height: 1.25em;background-color: gainsboro; padding-top: 0.25em">
     <h2>Type News/Notice</h2>
</div>
     <hr style=" color: #dbdbd5;">
     <?=form_open('welcome/UpdateNotice',array('onsubmit' => 'showLoader()'))?>
     <?=form_label('News/Notice Heading (Maximum 150 Character Allowed) :', 'notice_heading').br()?>
     <?php
            $txtBoxProperties = array(
                'name'     => 'entry_name',
                'id'       => 'entry_name',
                'value'    => set_value('entry_name',empty($notice[0]->Title)?'':$notice[0]->Title),
                'maxlength'=> '150',
                'size'     => '66'
            );
     ?>
     <?=form_input($txtBoxProperties)?>
     <?=form_error('entry_name', '<span class="errors">', '</span>')?>
     <hr style=" color: #dbdbd5;">
     <?php
            $textAreaProperties = array(
                'name' => 'entry_body',
                'id'   => 'entry_body',
                'value'=> set_value('entry_body',empty($notice[0]->Description)?'':stripslashes($notice[0]->Description)),
                'rows' => 24,
                'cols' => 63,
                'style'=> 'width:100%'
            );
     ?>
     <?=form_textarea($textAreaProperties)?>
     <?=form_error('entry_body', '<span class="errors">', '</span>')?>
     <hr style=" color: #dbdbd5;">
     <?=form_hidden('news_id', empty($notice[0]->Id)?'':$notice[0]->Id)?>
     <?=form_submit('submit', 'Update')?>
     <?=form_close()?>
     <hr style=" color: #dbdbd5;">
