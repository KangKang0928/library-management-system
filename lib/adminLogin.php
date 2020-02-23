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
        $name=$_POST["name"];
        $password=$_POST["password"];
        $charset="utf8";
        if($name=="admin" && $password=="admin"){
            header("content-type:text/html;charset=utf-8");
            header('location:adminTable.html');
        }
    ?>
</body>
</html>