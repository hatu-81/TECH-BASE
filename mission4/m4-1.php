<?php
    //DB接続設定
    //PHP領域に記載すること
    //4-2以降でも毎回接続は必要
    //$dsnの式の中にスペースを入れないこと
    
    //データベース名:tb260032db
    //ユーザー名:tb-260032
    //パスワード:euZ7NhXyEF
    $dsn ='mysql:dbname=tb260032db;host=localhost';
    $user ='tb-260032';
    $password ='euZ7NhXyEF';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>