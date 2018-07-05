<?php
function profiler_hook(){
    if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){
        $CI = &get_instance();
        $CI->output->enable_profiler(TRUE);
    }
}