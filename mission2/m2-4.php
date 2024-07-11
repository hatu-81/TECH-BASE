<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission2-4 </title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
        $filename = "mission2-4.txt";
        if ( !empty($_POST["str"]) ) {
            $str = $_POST["str"];
            //ファイルを追記モードで開いて記述をする
            $fp = fopen( $filename , "a");
            fwrite($fp, $str . PHP_EOL);
            fclose($fp);
            
            if ( $str == "完成" ) {
                echo $str . "おめでとう！<br>";    
            }else echo $str . "を受け付けました<br>";
            
        }
            
        //ファイルが存在したら書き込まれている内容を１行１要素として定義する
        if (file_exists($filename)) {
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            //配列の内容をループ処理でブラウザに表示させる
            foreach ($lines as $line) {
                echo $line . "<br>";
            }
        }
    ?>
</body>
</html>