<div class="sdmenu">
    <?php echo form_fieldset('<b>About Computer Society</b>');?>
    <div>
        <?php
            echo anchor('groups/show_all_member', 'Show All Member');
            echo anchor('groups/executive_body', 'Executive Body');
            echo anchor('groups/show_all_x_std', 'X-Student Body Member');
            foreach ($group_table as $row) {
                echo anchor('groups/application_project', $row->GroupName);
            }
        ?>
    </div>
    <?php echo form_fieldset_close();?>
</div>
