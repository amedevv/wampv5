<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'wav4';

try {
    //code...
    $db = mysqli_connect($host, $username, $password, $database);
    $db->set_charset('utf8mb4');
} catch (\Throwable $th) {
    throw $th;
}
