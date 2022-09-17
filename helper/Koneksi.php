<?php

$host = 'remotemysql.com';
$username = 'L1DMZixNFJ';
$password = '5LqwRCy38E';
$database = 'L1DMZixNFJ';

try {
    //code...
    $db = mysqli_connect($host, $username, $password, $database);
    $db->set_charset('utf8mb4');
} catch (\Throwable $th) {
    throw $th;
}
