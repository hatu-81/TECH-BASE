<?php
    $dsn ='mysql:dbname=tb260032db;host=localhost';
    $user ='tb-260032';
    $password ='euZ7NhXyEF';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql ='SHOW CREATE TABLE m6maindb';
    $result = $pdo -> query($sql); 

    // 取得したSQLを表示（指定したテーブルをCREATEしようと思った際のSQL）
    foreach ($result as $row){
        echo $row[1];
    }
    echo "<hr>";
?>