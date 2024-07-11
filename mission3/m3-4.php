<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission3-4 </title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力">
        <input type="text" name="str" placeholder="コメントを入力">
        <input type="submit" name="submit" value="送信">
    </form>
<br>
***<br>
<br>
    <?php
        //csvファイル名
        $filename = "mission3.csv";
        
        if ( !empty($_POST["name"]) && !empty($_POST["str"]) ) {
            $name = $_POST["name"];
            $str = $_POST["str"];
            $date = date( "Y/m/d H:i:s" );
            if (file_exists($filename)) {
                $num = count(file($filename)) + 1;
            }else {
                $num = 1;
            }
            //データを配列にする
            $data = [$num, $name, $str, $date];
            
            //csvファイルを'a'モードで開く
            $fp = fopen($filename, 'a');
            //fputcsv関数で配列を書き出す
            fputcsv($fp, $data);
            fclose($fp);
        }
        //ファイルが存在する場合には1行ずつ読み込む
        if (file_exists($filename)) {
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line) {
                $fields = explode ("," , $line);
                foreach ($fields as $field) {
                echo $field . "  ";
                }
                echo "<br>";
            }
            
        }
    ?>
</body>
</html>