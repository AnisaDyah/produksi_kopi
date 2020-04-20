<?php
function helper_log($tipe = "", $str = ""){
    $CI =& get_instance();
 
    if (strtolower($tipe) == "login"){
        $log_tipe   = 0;
    }
    elseif(strtolower($tipe) == "logout")
    {
        $log_tipe   = 1;
    }
    elseif(strtolower($tipe) == "add"){
        $log_tipe   = 2;
    }
    elseif(strtolower($tipe) == "edit"){
        $log_tipe  = 3;
    }
    elseif(strtolower($tipe) == "delete"){
        $log_tipe  = 4;
    }
    elseif(strtolower($tipe) == "validasi"){
        $log_tipe  = 5;
    }
    else{
        $log_tipe  = 6;
    }
 
    // paramter
    $param['log_user']      = $CI->session->userdata('id_user');
    $param['log_tipe']      = $log_tipe;
    $param['log_desc']      = $str;
 
    //load model log
    $CI->load->model('M_log');
 
    //save to database
    $CI->M_log->save_log($param);
 
}
?>