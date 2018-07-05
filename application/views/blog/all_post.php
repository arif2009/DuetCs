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
<div class="allPost">
<?php
$post_body = '';
$CI = &get_instance();
$CI->load->model('csdatabase');
$entryTable[0] = $CI->csdatabase->GetAllPost();
foreach ($entryTable[0] as $row)
{
    //For delete post
    $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
     if(($this->session->userdata('isLogedIn') && ($this->session->userdata('userId') == $row->user_id)) OR $condition)
     {
        $editPost = anchor('administration/edit_post/'.$row->entry_id, '<span class="editPostOrNews">XX</span>',array('title' => 'Edit Post','style'=>'text-decoration: none;'));
        $deletePost = anchor('administration/delete_post/'.$row->entry_id, '<span class="deletePostOrNews">X</span>',array('title' => 'Delete Post','style'=>'text-decoration: none;'));
        $editAndDeletPost = '<span style="float: right; width:45px">'.$editPost.nbs(3).$deletePost.'</span>';
     }
     else
     {
         $editAndDeletPost = '';
     }
     $post_athur = $row->entry_author_name.nbs(2).$row->entry_date."{$editAndDeletPost}".br(2);
     $post_body = stripslashes($row->entry_body);
?>
    <div>
        <!--Post Title-->
        <b><?=anchor('blog/post/'.$row->entry_id, "{$row->entry_name}")?></b><br/>
        <!--Author Name & Date-->
        <p style="color: #888888;clear:both"><?php echo $post_athur;?></p><br/>
     </div>
     
     <!--Entry Body-->
     <div class="more-less">
    	<div class="more-block">
        <p><?php echo $post_body;?></p>
        </div>
     </div>
     
     <!--Comments-->
     <?=br().'<span style="font-size:1.1em">Site-Comments('.$CI->csdatabase->CountComment($row->entry_id).')</span>'.nbs(3)?>
     <span style="font-size:1.1em">Facebook-Comments(<a href="<?=base_url('blog/post/'.$row->entry_id)?>" style="text-decoration: none" class="fb-comments-count">0</a>)</span>
     <fb:comments href="<?=base_url('blog/post/'.$row->entry_id)?>" num_posts='1' width='300' style="display: none"></fb:comments>
     <hr style=" color: #dbdbd5;">
<?php }?>
     <script src='http://connect.facebook.net/en_US/all.js#xfbml=1'></script>
</div>