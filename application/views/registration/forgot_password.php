<div id="loginForgotPassword">
    <?php 
    echo form_fieldset('Forgotten Password :');

    echo form_open($this->uri->uri_string());

    $login = array(
        'name'      => 'login',
        'id'        => 'login',
        'maxlength' => 80,
        'value' => set_value('login')
        );

    
    echo form_label('Email Address :', $login['id']);
    echo form_input($login);
    echo form_error($login['name'],'<p class="errors">','</p>');
    echo form_submit('reset', 'OK');


    echo form_close();

    echo form_fieldset_close() . br(2);
    ?>
</div>

