<script type="text/javascript">
$(function() {
    $("#tree").treeview({
	collapsed: true,
	animated: "medium",
	persist: "cookie",
    unique: true
    });
})
</script>
<div id=main>
<fieldset id="archive">Blog Archive</fieldset>
<ul id="tree">
<?php
$CI = &get_instance();
$CI->load->model('csdatabase');
$entryTable = $CI->csdatabase->GetAllYear();
foreach ($entryTable as $row) {
    echo"<li><span>$row->entry_year</span>";    //Year start
    echo"<ul>";
    $entryTable1 = $CI->csdatabase->GetAllMonth($row->entry_year);
    foreach ($entryTable1 as $row1)
    {
        echo"<li><span>$row1->entry_month</span>"; //Month start
        $entryTable2 = $CI->csdatabase->GetAllHeading($row1->entry_month,$row->entry_year);
            echo '<ul>';
            foreach ($entryTable2 as $row2)
            {
                echo '<li><span>'.anchor('blog/post/'.$row2->entry_id, $row2->entry_name).'</span></li>';
            }
            echo '</ul>';
        echo"</li>";    //Month end
    }
    echo"</ul>";
    echo"</li>";    //Year end
}
?>
</ul>
</div>

