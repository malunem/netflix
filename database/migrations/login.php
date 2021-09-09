<?php 
    $host = '127.0.0.1';
    $data = 'Netflix'; //database name
    $user = 'root'; //username
    $pass = 'rootroot'; //password
    $chrs = 'utf8mb4'; //character set
    $attr = "mysql:host=$host;dbname=$data;charset=$chrs;";
    $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
?>