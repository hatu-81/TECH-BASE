<?php
    $dsn ='mysql:dbname=tb260032db;host=localhost';
    $user ='tb-260032';
    $password ='euZ7NhXyEF';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //bindParamの引数（:nameなど）は4-2でどんな名前のカラムを設定したかで変える必要がある
    $id = 2; //変更する投稿番号
    
    $name = "坂田";
    $comment = "音楽聞きたい";
    
    $sql ='UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    //プレースホルダに変数を宛がう
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //実行
    $stmt->execute();
    
    $sql = 'SELECT * FROM tbtest ORDER BY id';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    
    foreach ($results as $row) {
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
?>