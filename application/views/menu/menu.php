<script type="text/javascript">
    $(function(){
        $('a#all').click(function(){
            $('.please-wait').fadeIn(200);
        });
    });
</script>
<div class="grid_2" style="color: transparent">.</div>
<div id="menuh">
        <ul>	
            <li><?php echo anchor('welcome', 'Home');?></li>
        </ul>
        <ul>	
		<li><?php echo anchor('welcome/registration', 'Registration');?></li>
	</ul>
        <ul>	
		<li><a href="#" class="top_parent">News/Notice</a>
		<ul>
			<li><?php echo anchor('welcome/ShowAllNotice', 'Show All Notice', 'id="all"');?></li>
                        <li><?php echo anchor('welcome/AddNewNotice', 'Add New');?></li>
		</ul>
		</li>
	</ul>
        <ul>	
		<li><?php echo anchor('image', 'Photo Gallery');?></li>
	</ul>
	<ul>
		<li><a href="#" class="top_parent">Blog</a>
		<ul>
			<li><?php echo anchor('blog/ShowAllPost', 'Show All Post','id="all"');?></li>
                        <li><?php echo anchor('blog/AddNewPost', 'Add New Post');?></li>
		</ul>
		</li>
	</ul>
        <ul>
		<li><a href="#" class="top_parent">Project</a>
		<ul>
			<li><?php echo anchor('welcome/show_all_project', 'Show All Project');?></li>
                        <li><?php echo anchor('welcome/add_a_new_project', 'Add New Project');?></li>
		</ul>
		</li>
	</ul>
	
	<ul>	
		<li><?php echo anchor('groups/executive_body', 'About CS', 'class="left_margine"');?></li>
	</ul>
</div> 	<!-- end the menuh-container div -->

