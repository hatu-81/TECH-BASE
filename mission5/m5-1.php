<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission5 </title>
</head>

<body>
    入力用フォーム
    <form action="" method="post">
        名前：<input type="text" name="name" placeholder="名前を入力"><br>
        コメント：<input type="text" name="str" placeholder="コメントを入力"><br>
        <input type="submit" name="submit1" value="送信"><br>
        
    </form> 
<hr><br>
    <?php
        //データベース設定処理
        $dsn ='mysql:dbname=データベース名;host=localhost';
        $user ='ユーザー名';
        $password ='パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        //新規投稿処理
        if ( !empty($_POST["name"]) && !empty($_POST["str"]) ) {
            $name = $_POST["name"];
            $comment = $_POST["str"];
            
            $sql = "INSERT INTO testdb (name, comment) VALUES (:name, :comment)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                
            $stmt->execute();
        }
        //これまでの投稿を表示する
        $sql = 'SELECT * FROM testdb ORDER BY id';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        
        //ループして、取得したデータを表示
        foreach ($results as $row) {
        //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            echo $row['created_at'];
        echo "<hr>";
        }
       
    ?>
    
</body>
</html>