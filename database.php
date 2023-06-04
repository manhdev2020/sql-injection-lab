<?php
// Thông tin kết nối cơ sở dữ liệu PostgreSQL
    $host = "postgres";
    $port = "5432";
    $dbname = "labs";
    $user = "admin";
    $password = "zIbHa*hLJBMK@wt9";

    global $db;

    // Kết nối đến cơ sở dữ liệu
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
    $db = new PDO($dsn);