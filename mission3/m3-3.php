<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission3-3 </title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力">
        <input type="text" name="str" placeholder="コメントを入力">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
        //csvファイル名
        $filename = "mission3.csv";
        
        if ( !empty($_POST["name"]) && !empty($_POST["str"]) ) {
            $name = $_POST["name"];
            $str = $_POST["str"];
            $date = date( 'Y/m/d H:i:s' );
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
    ?>
</body>
</html>