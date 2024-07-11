<?php
    $dsn ='mysql:dbname=データベース名;host=localhost';
    $user ='ユーザー名';
    $password ='パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    //【！このSQLはtbtestテーブルを削除します！】
    
    $sql = 'DROP TABLE m6maindb';
    $stmt = $pdo->query($sql);
?>