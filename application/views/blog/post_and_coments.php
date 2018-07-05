<!--For Showing a individual post-->
<div style="text-align: justify">
<?php
    $post_body = '';
    $CI = &get_instance();
    $duetCS = new DuetCS;
    $CI->load->model('csdatabase');
    $entryTable = $CI->csdatabase->GetBlog($postId);
    $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
    if(($this->session->userdata('isLogedIn') && ($this->session->userdata('userId') == $entryTable[0]->user_id)) OR $condition)
    {
        $editPost = anchor('administration/edit_post/'.$entryTable[0]->entry_id, '<span class="editPostOrNews">XX</span>',array('title' => 'Edit Post','style'=>'text-decoration: none;'));
        $deletePost = anchor('administration/delete_post/'.$entryTable[0]->entry_id, '<span class="deletePostOrNews">X</span>',array('title' => 'Delete Post','style'=>'text-decoration: none;'));
        $editAndDeletPost = '<span style="float: right; width:45px">'.$editPost.nbs(3).$deletePost.'</span>';
    }
    else
    {
        $editAndDeletPost = '';
    }
?>
<div><b><?=$entryTable[0]->entry_name?></b><br/>
    <span style="color: #888888">
        <?=$entryTable[0]->entry_author_name.nbs(2).$entryTable[0]->entry_date.$editAndDeletPost ?>
    </span>
</div>
<br/>
<p><?=stripslashes($entryTable[0]->entry_body)?></p>

<!--Facebook Like button-->
<br/>
<iframe src="//www.facebook.com/plugins/like.php?href=<?=current_url()?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
</div>

<!--For Showing all comments of a individual post-->
<div>
    <?php $data = $CI->csdatabase->GetComment($postId);?>
    <hr style=" color: #dbdbd5;">
    <div style=" height: 1.25em;background-color: gainsboro; padding-top: 0.25em">
        <h2>Site-Comments(<?=$data[0]?>)<?=nbs(5)?> <?php if(!$this->session->userdata('isLogedIn')){echo '<b style="color: red">For This Comments You Must Login.</b>';}?></h2>
    </div>
    <hr style=" color: #dbdbd5;">
    <?php foreach ($data[1] as $row_comment):
           $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
           if(($this->session->userdata('isLogedIn') && ($this->session->userdata('userId') == $row_comment->user_id)) OR $condition)
           {
                $delete_comments = anchor('administration/delete_comment/'.$postId.'/'.$row_comment->comment_id, '<span class="deletePostOrNews">X</span>',array('title' => 'Delete Comment','style'=>'text-decoration: none;'));
                $delete_comments = '<span style="float: right;">'.$delete_comments.'</span>';
           }
           else
           {
               $delete_comments = '';
           }
    ?>
           <span style="color: #888888">
               <?=$row_comment->comment_name.nbs(2).$row_comment->comment_date.$delete_comments ?>
           </span>
           <br/>
           <div>
               <?=$duetCS->FindLink(stripslashes($row_comment->comment_body))?>
           </div>
           <hr style=" color: #dbdbd5;">
   <?php endforeach; ?>
</div>
<!--If login Showing comments box-->
<div>
   <?php if($this->session->userdata('isLogedIn')){ ?>
      <div style=" height: 1.25em;background-color: gainsboro; padding-top: 0.25em">
        <h2>Type Your Comment</h2>
      </div>
      <hr style="color: #dbdbd5;">
   <?=form_open('blog/add_comment/'.$postId)?>
   <?php
          $commentBoxProperties = array(
                'name' => 'comment',
                'id'   => 'comment',
                'rows' => 6,
                'cols' => 63,
                'style'=> 'width:100%'
            );
          echo form_textarea($commentBoxProperties);
  ?>
          <?=form_error('comment', '<span class="errors">', '</span>')?>
          <hr style=" color: #dbdbd5;">
            <?=form_submit('submit', 'Add Comment')?>
          <hr style=" color: #dbdbd5;">

    <?=form_close()?>
    <?php }?>

    <!--Facebook Comment Box-->
    <hr style=" color: #dbdbd5;">
    <div style=" height: 1.25em;background-color: gainsboro; padding-top: 0.25em">
        <h2>Facebook-Comments(<script type="text/javascript">document.write("<a href='"+document.location.href +"' style='text-decoration: none' class='fb-comments-count'>0</a>");</script>)</h2>
    </div>
    <hr style=" color: #dbdbd5;">
    <script language="javascript" type="text/javascript">
    document.write("<div id='fb-root'></div><fb:comments href='"+ document.location.href +"'  num_posts='5' width='510'></fb:comments>");
    </script>
    <script src='http://connect.facebook.net/en_US/all.js#xfbml=1'></script>
</div>