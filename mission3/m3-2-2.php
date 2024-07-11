<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission3-2 </title>
</head>

<body>
    <?php
        //CSVファイル名
        $filename = "member.csv";
        //member.csvを読み込む（読み取り用）
        $fp = fopen( $filename , "r");
        //ループ前:テーブルタグを作成し、テーブルヘッダーで見出しを作る
        echo '<table border="1">
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mail</th>
            <th>Password</th>
            </tr>';
        
        //while文でCSVファイルのデータを１つずつ繰り返し読み込む
        while( $data = fgetcsv($fp) ) {
            //テーブルセルに配列の値を格納
            echo '<tr>';
            echo '<td>'.$data[0].'</td>';
            echo '<td>'.$data[1].'</td>';
            echo '<td>'.$data[2].'</td>';
            echo '<td>'.$data[3].'</td>';
            echo "</tr>";
        }
        fclose($fp);
    ?>
</body>
</html>