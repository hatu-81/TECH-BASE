<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> 入力フォーム作成 </title>
</head>

<body>
    <form action="" method="post">
        <input type="number" name="num" placeholder="数字を入力してください">
        <input type="submit" name="submit">
    </form>
    <?php
        $num = $_POST["num"];
        if ($num%3==0 && $num%5==0) {
            echo "FizzBuzz";
        }elseif ($num%3 == 0) {
            echo "Fizz";
        }elseif ($num%5 == 0) {
            echo "Buzz";
        }else {
            echo $num;
        }
    ?>
</body>
</html>