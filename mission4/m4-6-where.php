<?php
    $dsn ='mysql:dbname=tb260032db;host=localhost';
    $user ='tb-260032';
    $password ='euZ7NhXyEF';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    $id = 1; //idがこの値のデータだけを抽出したいとする
    
    //$rowの添え字は4-2でどんな名前のカラムを設定したかで変える必要がある
    $sql = 'SELECT * FROM tbtest WHERE id=:id';
    $stmt =$pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll();
    
    foreach ($results as $row) {
        //$row の中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }