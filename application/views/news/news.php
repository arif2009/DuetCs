<style type="text/css">
    #m_text{
        padding: 0 2px;
        text-align:justify;
    }
    #m_text a:link {text-decoration:none;color: black;}    /* unvisited link */
    #m_text a:visited {text-decoration:none;} /* visited link */
    #m_text a:hover {text-decoration:underline;}   /* mouse over link */
    #m_text a:active {text-decoration:underline;}  /* selected link */
</style>

<?php
 $CI = &get_instance();
 $CI->load->model('csdatabase');
 $entryTable = $CI->csdatabase->GetNews();
?>
<fieldset id="news_notice">News/Notice</fieldset>
<div class="news" style="border:3px solid #559CE1;margin-bottom: 2px;margin-top: 0;">
    <marquee id="m_text" onMouseOver="this.stop()" onMouseOut="this.start()" style="height:200px;" scrollamount="1.5" direction="up">
         <?php 
         foreach ($entryTable as $row)
         {
            echo anchor('welcome/ShowNotice/'.$row->id, $row->Title).br(2);
         }
         ?>
   </marquee>
</div>