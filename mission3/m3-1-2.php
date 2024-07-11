<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission3-1 </title>
</head>

<body>
    <?php
        //元となるデータを配列で用意（１件）
        $user = [
            'id' => 4,
            'name' => 'Dさん',
            'email' => 'ddd@d.com',
            'password' => 'ddddd'
        ];
        //CSVファイル名
        $filename = 'member.csv';
        //ファイルを'a'モードで開く（追記）
        $fp = fopen( $filename, 'a' );
        //csvフォーマットで書き出しする
        fputcsv($fp, $user);
        //ファイルを閉じる
        fclose($fp);
    ?>
</body>
</html>