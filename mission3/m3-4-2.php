<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission3-4 </title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            padding: 5px 10px;
            text-align: center;
        }
        tr {
            border-bottom: 2px solid #000;
        }
        .highlight {
            background-color: yellow;
        }
        
    </style>
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
            $fp = fopen($filename, 'r');
            echo '<table border="1">
                <tr>
                <th>Number</th>
                <th class="highlight">Name</th>
                <th>Comment</th>
                <th>Date</th>
                </tr>';
            //while文でCSVファイルのデータを１つずつ繰り返し読み込む
            while( $data = fgetcsv($fp) ) {
                //テーブルセルに配列の値を格納
                echo '<tr>';
                echo '<td>'.$data[0].'</td>';
                echo '<td class="highlight">'.$data[1].'</td>';
                echo '<td>'.$data[2].'</td>';
                echo '<td>'.$data[3].'</td>';
                echo "</tr>";
            }
            fclose($fp);
        }
    ?>
</body>
</html>