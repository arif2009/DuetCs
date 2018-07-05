<div id="loginContent">
    <?php echo form_fieldset('Login');?>
    <!--    For Showing Error-->
    <?php
    $this->form_validation->set_error_delimiters('<li>', '</li>');
    if($this->uri->segment(2) == 'validata_login'){
        $loginView = '<ul class="errors">';
        $loginView.= validation_errors();
        if (!empty($login_error)) {
            $loginView.= '<li>' . $login_error . '</li>';
        }
        $loginView.= '</ul>';
        echo $loginView;
    }
    ?>

    <!--    Design Login Form-->
    <?php echo form_open('welcome/validata_login');?>
    <?php
    $name = form_label('User Id (Student Id) :', 'userId');
    $name.= form_input('userId', set_value('userId'));
    $name.= nbs() . anchor('welcome/registration', 'Register') . br(2);
    echo $name;
    ?>

    <?php
    $password = form_label('Password : ', 'password');
    $password.= form_password('password');
    $password.= nbs() . anchor('welcome/forgot_password', 'Forgot your password?') . br(2);
    $data = array(
        'name' => 'rember_me',
        'value' => 'accept',
        'checked' => FALSE
    );
    $password.= form_checkbox($data) . ' Remember Me' . nbs(3);
    echo $password;
    ?>

    <?php
    $data = array(
        'name' => 'submit',
        'value' => 'Login'
    );
    echo form_submit($data);
    ?>
    <?php echo form_close();?>

    <?php echo form_fieldset_close('<br/>');?>
</div>
