<?php
    $dsn ='mysql:dbname=tb260032db;host=localhost';
    $user ='tb-260032';
    $password ='euZ7NhXyEF';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    //【！このSQLはtbtestテーブルを削除します！】
    
    $sql = 'DROP TABLE tbtest';
    $stmt = $pdo->query($sql);
?>