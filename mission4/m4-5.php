<?php
    $dsn ='mysql:dbname=tb260032db;host=localhost';
    $user ='tb-260032';
    $password ='euZ7NhXyEF';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $name = '初谷';
    $comment = 'どういたしまして';
    
    $sql = "INSERT INTO tbtest (name, comment) VALUES (:name, :comment)";
    $stmt = $pdo->prepare($sql);
    //プレースホルダに変数を宛がう
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    
    //実行
    $stmt->execute();
?>