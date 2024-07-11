<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission2-2 </title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
        $filename = "mission2.txt";
        if ( !empty($_POST["str"]) ) {
            $str = $_POST["str"];
            //ファイルを上書きモードで開いて記述をする
            $fp = fopen( $filename , "w");
            fwrite($fp, $str . PHP_EOL);
            fclose($fp);
            
            if ( $str == "完成" ) {
                echo $str . "おめでとう！";    
            }else echo $str . "を受け付けました";
        }
    ?>
</body>
</html>