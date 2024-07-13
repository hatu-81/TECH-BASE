<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>自己紹介掲示板</title>
</head>
<body>
    <style>
        h1 {
            padding: 10px;
            background-color: #f9f9f9;
            color: green;
            font-style: ;
        }
        h2 {
            position: relative;
            padding: 1.5rem 2rem;
            border: 3px solid #d8d8d8;
            border-radius: 10px;
            background: #f9f9f9;
        }
        
         h2:before {
            position: absolute;
            bottom: -14px;
            left: 1em;
            width: 0;
            height: 0;
            content: '';
            border-width: 14px 12px 0 12px;
            border-style: solid;
            border-color: #d8d8d8 transparent transparent transparent;
        }

        h2:after {
            position: absolute;
            bottom: -10px;
            left: 1em;
            width: 0;
            height: 0;
            content: '';
            border-width: 14px 12px 0 12px;
            border-style: solid;
            border-color: #f9f9f9 transparent transparent transparent;
        }
    </style>
    <?php
        // DB接続設定
        $dsn ='mysql:dbname=データベース名;host=localhost';
        $user ='ユーザー名';
        $password ='パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        // 編集用フォーム用データ取得
        $edit_id = "";
        $edit_name = "";
        $edit_comment = "";

        // 編集ボタンが押されたときの処理
        if (isset($_POST['submit2'])) {
            $id = $_POST['id1'];
            $pass = $_POST['pass2'];
            $sql = 'SELECT * FROM m6maindb WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result && $result['password'] === $pass) {
                $edit_id = $result['id'];
                $edit_name = $result['name'];
                $edit_comment = $result['comment'];
            }
        }
    // ファイルアップロード処理
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $uploaded_file = $upload_dir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_file)) {
            $image_path = $uploaded_file;
        } else {
            $image_path = null;
        }
    }

    // データベースに投稿内容を保存する処理
    if (isset($_POST['submit1'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $pass = $_POST['pass1'];
        $edit_id = $_POST['edit_id'];
        
        if ($edit_id) {
            // 編集処理
            $sql = 'UPDATE m6maindb SET name=:name, comment=:comment, password=:pass, image=:image WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image_path, PDO::PARAM_STR);
            $stmt->bindParam(':id', $edit_id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // 新規投稿処理
            $sql = 'INSERT INTO m6maindb (name, comment, password, image) VALUES (:name, :comment, :pass, :image)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image_path, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
    //削除処理
    if ( !empty($_POST["id2"]) && !empty($_POST["pass3"]) ) {
            $id = $_POST["id2"];
            $password = $_POST["pass3"];
            $sql = 'delete from m6maindb where id=:id AND password=:password';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
        }
?>

    <h1>自己紹介掲示板</h1>
    <!-- 投稿用フォーム -->
    <h2>投稿用フォーム</h2>
    <form action="" method="post" enctype="multipart/form-data">
        名前：<input type="text" name="name" placeholder="ニックネーム等" value="<?php echo $edit_name; ?>"><br>
        コメント：<div>
            <label for="comment"></label>
            <textarea id="comment" name="comment" cols="50" rows="10" placeholder="コメントを入力"><?php echo $edit_comment;?></textarea>
        </div>
        画像：<input type="file" name="file"><br>
        パスワード：<input type="password" name="pass1" placeholder="0000">
        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
        <input type="submit" name="submit1" value="送信">
    </form>
    <hr>

    <!-- 編集用フォーム -->
    <h2>編集用フォーム</h2>
    <form action="" method="post">
        対象番号：<input type="number" name="id1" placeholder="編集したい番号を入力"><br>
        パスワード：<input type="password" name="pass2" placeholder="0000">
        <input type="submit" name="submit2" value="編集">
    </form>
    <hr>

    <!-- 削除用フォーム -->
    <h2>削除用フォーム</h2>
    <form action="" method="post">
        対象番号：<input type="number" name="id2" placeholder="削除したい番号を入力"><br>
        パスワード：<input type="password" name="pass3" placeholder="0000">
        <input type="submit" name="submit3" value="削除">
    </form>
    <hr><br>

    <?php
        // これまでの投稿を表示する
        $sql = 'SELECT * FROM m6maindb ORDER BY id';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // ループして、取得したデータを表示
        foreach ($results as $row) {
            echo $row['id'] . ' ';
            echo $row['name']  . ' ';
            echo $row['comment'] . ' ';
            echo $row['created_at'] . ' ';
            if (!empty($row['image'])) {
                echo '<br><img src="' . $row['image'] . '" alt="Uploaded Image" width="200">';
            }
            echo "<hr>";
        }
    ?>
</body>
</html>
