<div class="sdmenu">
    <?php echo form_fieldset('<b>Admin Panel</b>');?>
    <div>
        <?php
            echo anchor('administration/get_std_to_make_admin', 'Add / Remove Admin');
            echo anchor('administration/manage_x_std', 'Manage X-Student');
            echo anchor('administration/select_exec_body', 'Member Management');
            echo anchor('administration/requested_student', 'Requested Student');
        ?>
    </div>
    <?php echo form_fieldset_close();?>
</div>
