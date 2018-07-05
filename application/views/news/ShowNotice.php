<div style="text-align: justify">
<?php
    $duetCS = new DuetCS;
    $CI = &get_instance();
    $CI->load->model('csdatabase');
    $entryTable = $CI->csdatabase->GetNewsContent($noticeId);
    if($entryTable != FALSE)
    {
        $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
        if($condition)
        {
            $editPost = anchor('administration/edit_notice/'.$entryTable[0]->Id, '<span class="editPostOrNews">XX</span>',array('title' => 'Edit Notice','style'=>'text-decoration: none;'));
            $delete_notice = anchor('administration/delete_notice/'.$entryTable[0]->Id, '<span class="deletePostOrNews">X</span>', array('title' => 'Delete Notice','style'=>'text-decoration: none;'));
            $editAndDeletPost = '<span style="float: right; width:45px">'.$editPost.nbs(3).$delete_notice.'</span>';
        }
        else
        {
            $editAndDeletPost = '';
        }
?>
     <span style="font-size: 15px;"><b><?=$entryTable[0]->Title?></b></span>
     <br />
     <span style="color: #888888;"><?=$entryTable[0]->Date?></span><?=$editAndDeletPost?>
     <hr/>
     <?=stripslashes($entryTable[0]->Description)?>
     <hr/>
<?php }else{?>
        <div style="color:red;text-align:center"><b>Invalid news</b></div>
<?php }?>
<!--Facebook Like button-->
<br/>
<iframe src="//www.facebook.com/plugins/like.php?href=<?=current_url()?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
<br/><br/>
</div>