<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>  </title>
</head>

<body>
    <?php
        //CSVファイル名
        $filename = "member.csv";
        //member.csvを読み込む（読み取り用）
        $fp = fopen( $filename , "r");
        
        //while文でCSVファイルのデータを１つずつ繰り返し読み込む
        while( $data = fgetcsv($fp) ) {
            //配列の値を表示
            echo $data[0].' ';
            echo $data[1].' ';
            echo $data[2].' ';
            echo $data[3].' ';
            echo "<br>";
        }
        fclose($fp);
    ?>
</body>
</html>