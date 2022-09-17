<?php
 
 
session_start();
 
date_default_timezone_set('Asia/Jakarta');
 
define('BASE_URL', 'http://whagatewayapiv1.herokuapp.com/');
 
define('URL_WA', 'http://whagatewayapiv1.herokuapp.com/');
 
define('LICENSE_KEY', '39be1f21-6e91-438a-a6b8-4e480e972ab9');
 
require('Koneksi.php');
 
require('../php/Auth.php');
 
require('../php/Autoresponder.php');
 
require('../php/Home.php');
 
require('../php/Contact.php');
 
require('../php/Messages.php');
 
// require('../php/Blast.php');
 
function apikey()
 
{
 
    $n = 20;
 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
    $randomString = '';
 
 
    for ($i = 0; $i < $n; $i++) {
 
        $index = rand(0, strlen($characters) - 1);
 
        $randomString .= $characters[$index];
 
    }
 
 
    return $randomString;
 
}
 
 
 
function setFlashMsg($type, $msg)
 
{
 
    $_SESSION['alert'] = ['color' => $type, 'msg' => $msg];
 
    return;
 
}
 
 
function back($loc)
 
{
 
    header('Location: ' . $loc);
 
    exit;
 
}
 
 
function uploadFile($file)
 
{
 
 
    $target_dir = "images/";
 
    $target_file = $target_dir . basename($file['name']);
 
    $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
 
    $allow = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
 
    if ($file['size'] > 1000000) {
 
        $_SESSION['alert'] = ['color' => 'danger', 'msg' => 'Maximal 10 mb!'];
 
        back('autoresponder.php');
 
    } else if (!in_array($ext, $allow)) {
 
        $_SESSION['alert'] = ['color' => 'danger', 'msg' => 'Hanya format JPG,JPEG,PNG,PDF,DOCX yang diizinkan!'];
 
        back('autoresponder.php');
 
    }
 
    $namefile = round(microtime(true)) . mt_rand() . '.' . $ext;
 
    $target = $target_dir . $namefile;
 
    if (move_uploaded_file($file["tmp_name"], $target)) {
 
        return $target;
 
    }
 
    return false;
 
}
 
 
function tgl_indo($tanggal)
 
{
 
    $bulan = array(
 
        1 =>   'Januari',
 
        'Februari',
 
        'Maret',
 
        'April',
 
        'Mei',
 
        'Juni',
 
        'Juli',
 
        'Agustus',
 
        'September',
 
        'Oktober',
 
        'November',
 
        'Desember'
 
    );
 
    $d = explode(' ', $tanggal);
 
    $pecahkan = explode('-', $d[0]);
 
 
    // variabel pecahkan 0 = tanggal
 
    // variabel pecahkan 1 = bulan
 
    // variabel pecahkan 2 = tahun
 
 
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] . '  ' . $d[1];
 
}
 
 
function redirect($target)
 
{
 
    echo '
 
   <script>
 
   window.location = "' . $target . '";
 
   </script>
 
   ';
 
    exit;
 
}
