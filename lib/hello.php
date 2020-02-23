<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        echo '<h1>hello world!</h1>';
        echo date("当前时间：Y-m-d H:i:s");
        echo"<br>";
        if( mysqli_connect('localhost','root','425879')){
            echo "连接成功！";
        }else{
            echo "连接失败！";
        }
    ?>
</body>
</html>