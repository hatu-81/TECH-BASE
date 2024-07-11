<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> mission3-1 </title>
</head>

<body>
    <?php
    //もととなるデータを配列で用意
    $users = [
        [
            'id' => 1,
            'name' => 'Aさん',
            'email' => 'aaa@a.com',
            'password' => 'aaaaa'
        ],
        [
            'id' => 2,
            'name' => 'Bさん',
            'email' => 'bbb@b.com',
            'password' => 'bbbbb'
        ],
        [
            'id' => 3,
            'name' => 'Cさん',
            'email' => 'ccc@c.com',
            'password' => 'ccccc'
        ]
    
    ];
    //CSVファイル名
    $filename = 'member.csv';
    //ファイルを'w'モードで開く（上書き）
    $fp = fopen( $filename, 'w' );
    //foreachでループ
    foreach ($users as $line) {
        //csvフォーマットで書き出しをする
        fputcsv($fp, $line);
    }
    //ファイルを閉じる
    fclose($fp);
    
    ?>
</body>
</html>