<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission_1-27 </title>
</head>

<body>
    <form action="" method="post">
        <input type="number" name="num" placeholder="数字を入力してください">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
        //ファイルを作成する
        $filename="m_1-27.txt";
        //$numに$＿POST関数を代入する(中身がからでない場合)
        if ( isset($_POST["num"]) ) {
            $num = $_POST["num"];
        //ファイルを追記モードで開く
        $fp = fopen ($filename, "a");
        fwrite($fp, $num . PHP_EOL);
        fclose($fp);
        }
        echo "書き込み成功！<br>";
        
         if ( file_exists($filename) ) {
        //ファイルの内容を、変数$linesに1行1要素の配列として定義
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        //配列の内容でループ
        foreach( $lines as $line ) {
            if ($line%3==0 && $line%5==0) {
                echo "FizzBuzz<br>";
            }elseif ($line%3 == 0) {
                echo "Fizz<br>";
            }elseif ($line%5 == 0) {
                echo "Buzz<br>";
            }else {
                echo $line."<br>";
            }
        }
        }
        
        
    ?>
</body>
</html>