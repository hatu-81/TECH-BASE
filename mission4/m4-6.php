<?php
    $dsn ='mysql:dbname=tb260032db;host=localhost';
    $user ='tb-260032';
    $password ='euZ7NhXyEF';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //$rowの添え字（[]内）は、4-2で作成したカラムの名称に合わせる必要がある
    $sql = 'SELECT * FROM tbtest ORDER BY id';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    
    //ループして、取得したデータを表示
    foreach ($results as $row) {
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
?>