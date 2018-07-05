<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DUET Computer Society</title>
    <?php echo $metaTag;?>
    <?php echo $head;?>
</head>

<body>
    <!--For Loading Animation-->
    <div class="please-wait"></div>
    
    <div class="container_24 clearfix" id="maincontainer">
    <header class="clearfix">
    <?php echo $header;?>
    <?php $this->load->view('menu/menu');?>
    </header>

    <div class="clearfix"><!--Container Div-->
    <aside class="grid_6"><!--Left Aside-->
        <?php 
            $this->load->view($leftContent);
            $condition = ($this->session->userdata('admin') == 'yes' OR $this->session->userdata('userId') == '074051' OR $this->session->userdata('userId') == '084002' OR $this->session->userdata('userId') == '044045');
            if($condition){
                $this->load->view('menu/admin_menu');
            }
            if($this->uri->segment(1) == 'groups'){
                $this->load->view('menu/side_menu');
            }
        ?>
    </aside>

    <div class="grid_13">
        <?php $this->load->view($content);?>
    </div>
    
     <aside class="grid_5"><!--Right Aside-->
         <?php $this->load->view('news/news');?>
         <?php $this->load->view('blog/archive');?>
    </aside>
    </div>

    <footer>
    <?php echo $footer;?>
    </footer>

    </div>
    <!--Blog and Notice deleting confirmation message-->
    <script type="text/javascript">
    //Confirm message
    $(function(){
        $('span.deletePostOrNews').click(function(){
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
</body>
</html>