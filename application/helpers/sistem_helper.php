<?php 
function Kadep_access(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 1 ){
        redirect('LoginC/logout');
    }
}

function Sekdep_access(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 2 && $ci->session->userdata('kode_unit') != 1){
        redirect('LoginC/logout');
    }
}

function Man_sarpras_access(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 3 ){
        redirect('LoginC/logout');
    }
}

function Man_keuangan_acess(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 3 && $ci->session->userdata('kode_unit') != 3){
        redirect('LoginC/logout');
    }
}

function Staf_sarpras_access(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 4 && $ci->session->userdata('kode_unit') != 2){
        redirect('LoginC/logout');
    }
}

function Staf_keuangan_access(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 4  && $ci->session->userdata('kode_unit') != 3){
        redirect('LoginC/logout');
    }
}

function Mahasiswa_access(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 5  && $ci->session->userdata('kode_unit') != 8){
        redirect('LoginC/logout');
    }
}

function Staf_access(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 4  && $ci->session->userdata('kode_unit') == 3  || $ci->session->userdata('kode_unit') == 2){
        redirect('LoginC/logout');
    }
}

function Kepala_unit_access(){
    $ci=& get_instance();
    if($ci->session->userdata('kode_jabatan') != 1 && $ci->session->userdata('kode_unit') == 1){
        redirect('LoginC/logout');
    }
}

if ( ! function_exists('redirect_back')){ //untuk redirect kembali ke halaman sebelumnya
    function redirect_back(){
        if(isset($_SERVER['HTTP_REFERER']))
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
        exit;
    }
}