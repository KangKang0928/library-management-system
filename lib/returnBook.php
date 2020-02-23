<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./ico/图书归还.png">
    <title>归还结果</title>
    <style type="text/css">
        body{
            background-image:url("./pic/antelope-canyon-1128815_1920.jpg");
            background-size:cover;
            background-repeat:no-repeat;
        }
        pre{
            margin-top:40px;
            font-size:20px;
            text-align:center;
        }
        .head1{
            text-align:center;
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
        .one{
            text-align:center;
            font-size:20px;
        }
        .two{
            color:red;
            text-align:center;
            font-size:20px;
        }

    </style>
</head>
<body>

    <?php
    //（1）设置接收变量
    $stuNo=$_POST["stuNo"];
    $bookNo=$_POST["bookNo"];
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
    //（5）设置sql语句


    // 1、找出借阅信息
    $sql2="select * from sb where 学号='$stuNo' and 书号='$bookNo'";
    $result2=mysqli_query($link,$sql2);

    //如果存在借阅信息，则删除借阅记录，并把该书籍的库存加1
    if($result2){
        $sql1="delete from sb where 学号='$stuNo' and 书号='$bookNo'";
        $result1=mysqli_query($link,$sql1);
        //如果归还成功，就更新book表中的库存，并且返回还书成功
        if($result1){
            $sql3="update book set 库存=库存+1 where 书号='$bookNo'";
            $result3=mysqli_query($link,$sql3);
            echo'<div class="back">
            <div class="head1">
        <h1>还书结果</h1>
    </div>    
            <div class="one">';
            echo"还书成功";
            echo'</div><div class="head2">
            <a href="./returnBook.html"><返回上级</a>
        </div></div>';
        }else{
            //没还成功就不更新库存
            echo'<div class="back"><div class="head1">
            <h1>还书结果</h1>
        </div><div class="two">';
            echo"不存在该借阅";
            echo'</div><div class="head2">
            <a href="./returnBook.html"><返回上级</a>
        </div></div>';
        }
    }else{
        //找不到借阅信息，返回账号不存在
        echo'<div class="back"><div class="head1">
        <h1>还书结果</h1>
    </div><div class="two">';
        echo"学号和书号不匹配";
        echo'</div><div class="head2">
        <a href="./returnBook.html"><返回上级</a>
    </div></div>';
    }
    // var_dump($result);
    //手动释放result变量
    // mysqli_free_result($result1);
    
    ?>
    
    
</body>
</html>