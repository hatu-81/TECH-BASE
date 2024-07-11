<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> 新規登録・ログインページ </title>
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
        }
    </style>
<?php
    //登録されていない新規登録
    if ( !empty($_POST["name1"]) && !empty($_POST["pass1"]) ) {
        if (file_exists($filename)) {
            $name = $_POST["name1"];
            $pass = $_POST["pass1"];
            $members = [$name, $pass];
            
            $fp = fopen($filename, 'a');
            fputcsv ($fp, $members);
            fclose($fp);
            echo "登録されました<br>";
            
        }
    }//登録してある人がログインした時
    elseif ( !empty($_POST["name2"]) && !empty($_POST["pass2"]) ) {
        //ログイン
        if (file_exists($filename)) {
            $name = $_POST["name2"];
            $pass = $_POST["pass2"];
            $found = false;
            
            $fp = fopen($filename, 'r');
            while (($data = fgetcsv($fp)) !== FALSE) {
                if ($data[0] == $name && $data[1] == $pass) {
                    $found = true;
                    break;
                }
            }
            fclose($fp);
            
            if ($found) {
                echo "ログイン成功<br>";
                header("Location:https://tech-base.net/tb-260032/mission6/m6-main-2.php");
                exit();
            } else {
                echo "ユーザー名またはパスワードが間違っています<br>";
            }
        } else {
            echo "ユーザーが登録されていません<br>";
        }
        
    }
    
?>
    <h1>新規登録・ログインページ</h1>
    <h2>新規登録用フォーム</h2>
    <form action="" method="post">
        名前：<input type="text" name="name1" placeholder="名前を入力" ><br>
        パスワード：<input type="password" name="pass1" placeholder="パスワードを入力"><br>
        <input type="submit" name="submit1" value="送信">
    </form><hr>
    <h2>ログイン用フォーム</h2>
    <form  action="" method="post">
        名前：<input type="text" name="name2" placeholder="名前を入力"><br>
        パスワード：<input type="password" name="pass2" placeholder="パスワードを入力"><br>
        <input type="submit" name="submit2" value="ログイン">
    </form>
<br>
</body>
</html>