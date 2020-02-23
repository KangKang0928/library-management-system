<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./ico/删 除 .png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>删除结果</title>
    <style type="text/css">
    body{
        background-image:url("./pic/switzerland-862870_1920.jpg");
        background-size:cover;
        background-repeat:no-repeat;
    }
        .result1{
            text-align:center;
            font-size:60px;
            margin-top:50px;
            margin-bottom:60px;
        }
        .result2{
            text-align:center;
            color:red;
            font-size:60px;
            margin-top:50px;
        }
        .result2 p{
            font-size:20px;
            margin-top:70px;
        }

        .head2{
            margin:0 auto;
        }
        .head2 a{
            position: relative;
            display: inline-block;
            text-decoration:none;
            color:black;
            background-color:#fff;
            padding:20px 20px;
            border-radius:10px;
            letter-spacing: 4px;
            font-size: 20px;
            transition: 0.2s;
        }

       .head2 a:hover{
            color: black;
            background: #f6e58d;
            box-shadow: 0 0 10px #f6e58d,0 0 40px #f6e58d,0 0 80px #f6e58d;
        }

        .back{ 
            width: 480px;
            background: rgba(255, 255, 255, 0.9);
            /* height: 680px; */
            padding: 40px 40px;
            border-radius: 25px;
            position: absolute;
            left: 50%;
            top: 50%;
            
            transform: translate(-50%,-50%);
        }
        
    </style>
</head>
<body>
    <?php
    //（1）设置接收变量
    $BookID=$_POST["bookID"];
    $BookName=$_POST["bookName"];
    $db_name="database";
    $charset="utf8";
    //（2）连接数据库
    $link =mysqli_connect("localhost","root","425879");
    if(!($link)){
        echo"<h2>连接失败！</h2>";
        die();
    }
    //（3）选择数据库
    if(!mysqli_select_db($link,$db_name)){
        echo"<h2>选择数据库{$db_name}失败！</h2>";
        die();
    }
    //（4）设置mysql字符编码
    mysqli_set_charset($link,$charset);

    
    //2、delete
    $sql1="delete from book where book.书号='{$BookID}' and book.书名='{$BookName}'";
    $result1=mysqli_query($link,$sql1);
    if($result1){
        echo'<div class="back">
                <div class="result1">操作完成</div>
                <div class="head2">
                    <a href="./dropBook.html"><返回上级</a>
                </div>
            </div>';
    }else{
        echo'<div class="back">
                    <div class="result2">删除失败';
        echo"           <br><p>可能的原因是不存在图书或者是图书已被借出仍未归还<p>";
        echo'       </div>
                <div class="head2">
                    <a href="./dropBook.html"><返回上级</a>
                </div>
            </div>';
    }
    mysqli_close($link);
    ?>
    
    
</body>
</html>