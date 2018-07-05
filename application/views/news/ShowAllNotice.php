<script type="text/javascript">
$(function(){
    // The height of the content block when it's not expanded
    var adjustheight = 80;
    // The "more" link text
    var moreText = "+  Read More";
    // The "less" link text
    var lessText = "- Less";

    // Sets the .more-block div to the specified height and hides any content that overflows
    $(".more-less .more-block").css('height', adjustheight).css('overflow', 'hidden');
    // The section added to the bottom of the "more-less" div
    $(".more-less").append('<a href="#" class="adjust"></a>');
    $("a.adjust").text(moreText);

    $(".adjust").toggle(function() {
            $(this).parents("div:first").find(".more-block").css('height', 'auto').css('overflow', 'visible');
            $(this).text(lessText);
        }, function() {
            $(this).parents("div:first").find(".more-block").css('height', adjustheight).css('overflow', 'hidden');
            $(this).text(moreText);
    });
});
</script>
<div>
<?php
$duetCS = new DuetCS;
$CI = &get_instance();
$CI->load->model('csdatabase');
$entryTable = $CI->csdatabase->GetAllNotice();
foreach ($entryTable as $row)
{
    //For delete Notice
    $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
     if($condition)
     {
         $editPost = anchor('administration/edit_notice/'.$row->Id, '<span class="editPostOrNews">XX</span>',array('title' => 'Edit Notice','style'=>'text-decoration: none;'));
         $delete_notice = anchor('administration/delete_notice/'.$row->Id, '<span class="deletePostOrNews">X</span>', array('title' => 'Delete Notice','style'=>'text-decoration: none;'));
         $editAndDeletPost = '<span style="float: right; width:45px">'.$editPost.nbs(3).$delete_notice.'</span>';
     }
     else
     {
         $editAndDeletPost = '';
     }
?>
    <!--For Notice Title-->
    <span style="font-size: 15px;"><b><?=anchor('welcome/ShowNotice/'.$row->Id, "{$row->Title}")?></b></span>
    <br />
    <span style="color: #888888;"><?php echo $row->Date;?></span><?php echo $editAndDeletPost;?><hr/>
    
    <!--Notice Body-->
     <div class="more-less">
    	<div class="more-block">
        <p><?php echo stripslashes($row->Description);?></p>
        </div>
     </div>

    <hr/>
<?php
}
?>
</div>