<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission5 </title>
</head>

<body>
    <?php
        //データベース設定処理
        $dsn ='mysql:dbname=データベース名;host=localhost';
        $user ='ユーザー名';
        $password ='パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        //編集フォーム用データ取得
        $edit_id = "";
        $edit_name = "";
        $edit_comment = "";
        
        //新規投稿処理
        if ( !empty($_POST["name"]) && !empty($_POST["str"]) ) {
            $name = $_POST["name"];
            $comment = $_POST["str"];
            
            if ( empty($_POST["edit_id"]) ) {
                $sql = "INSERT INTO m5db (name, comment) VALUES (:name, :comment)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                
                $stmt->execute();
            }else {
                //編集モードの場合
                $current_datetime = date('Y-m-d H:i:s');
                $edit_id = $_POST["edit_id"];
                $sql = 'UPDATE m5db SET name=:name, comment=:comment, created_at=:created_at WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam(':created_at', $current_datetime, PDO::PARAM_STR);
                $stmt->bindParam(':id', $edit_id, PDO::PARAM_INT); 
                
                $stmt->execute();
            }
        }
        //削除用フォーム
        if ( !empty($_POST["id1"]) ) {
            $id = $_POST["id1"];
            $sql = 'delete from m5db where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
            $stmt->execute();
        }
        //編集用フォーム
        if ( !empty($_POST["id2"]) ) {
            $id = $_POST["id2"];
            $sql = 'SELECT * FROM m5db WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll();
            
            foreach ( $results as $row ) {
                $edit_id = $row['id'];
                $edit_name = $row['name'];
                $edit_comment = $row['comment'];
            }
        }
    ?>
   
入力用フォーム
        <form action="" method="post">
        名前：<input type="text" name="name" placeholder="名前を入力" value="<?php echo $edit_name;?>"><br>
        コメント：<input type="text" name="str" placeholder="コメントを入力" value="<?php echo $edit_comment;?>"><br>
        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
        <input type="submit" name="submit1" value="送信"><br>
        
    </form> 
<hr>削除用フォーム
    <form action="" method="post">
        削除対象番号：<input type="number" name="id1" placeholder="削除したい番号を入力">
        <input type="submit" name="submit2" value="削除"><br>
    </form>
<hr>編集用フォーム
    <form action="" method="post">
        編集対象番号:<input type="number" name="id2" placeholder="編集したい番号を入力">
        <input type="submit" name="submit3" value="編集"><br>
    </form>
    <hr><br>
    <?php
        //これまでの投稿を表示する
        $sql = 'SELECT * FROM m5db ORDER BY id';
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