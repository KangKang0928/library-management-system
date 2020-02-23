<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./ico/借阅申请.png">
    
    <title>借阅书籍</title>
    <style type="text/css">
        body{
            background-image:url("./pic/fall-1072821_1920.jpg");
            background-size:cover;
            background-repeat:no-repeat;
        }
        pre{
            margin-top:40px;
            font-size:20px;
            text-align:center;
        }
        .f2{
            text-align:center;
            font-size:30px;
        }
        .error{
            text-align:center;
            font-size:30px;
            color:red;
            margin:10px;
        }
        .success{
            text-align:center;
            font-size:30px;
            margin:10px;
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
        .table{
            margin:80px auto;
            text-align:center;
            border-collapse:collapse;
            color:#333333;
            border-width:1px;
            border-color:#666666;
            font-size:21px;
        }
        .table td{
            
            padding:20px;
            background-color:white;
            border-style:dashed;
            border-color:white;
            background-color:rgba(255,255,255,0.6);
        }
        .back{ 
            width: 1200px;
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
    error_reporting(0);
    //（1）设置接收变量
    $stuNo=$_POST["stuNo"];
    $password=$_POST["password"];
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
    //（5）设置各种sql语句，php不认识sql语句，只有mysql认识SQL语句
    
    // 1、找出数据库学生账号的密码
    $sql2="select 密码 from sap where 学号='$stuNo'";
    $result2=mysqli_query($link,$sql2);
    
    //2、借出书的信息
    $sql4="select * from book where 书号='$bookNo'";
    $result4=mysqli_query($link,$sql4);

    //3、学生信息
    $sql5="select * from stu where 学号='$stuNo'";
    $result5=mysqli_query($link,$sql5);

    //4、库存信息
    $sql6="select 库存 from book where 书号='$bookNo'";
    $result6=mysqli_query($link,$sql6);
    
    //5、满足 密码正确、有这个书、有这个学生、库存不为0方可借书
    if(($password==$result2->fetch_assoc()['密码']) && ($result4) && ($result5) && ($result6->fetch_assoc()['库存']>0)){
        
        //6、满足5的条件，把借阅的信息放入sb表中
        $sql1="insert into sb(书号,学号,借阅日期) values ('$bookNo','$stuNo',now())";
        $result1=mysqli_query($link,$sql1);
        
        //7、更新book表中的库存，根据规定，一个人不能同时借阅多本同一种书
        if($result1){
            $sql3="update book set 库存=库存-1 where 书号='$bookNo'";
            $result3=mysqli_query($link,$sql3);
            //2、select
            $sql="select* from book where 书号='$bookNo'";
            $result=mysqli_query($link,$sql);
            echo'<div class="back">
            <div class="f2">';
    echo"       <h2>借阅成功,结果如下</h2>";
    echo'   </div>
            <div class="table_style">
            <table border="1" class="table">
            <tr>
                <td>书号</td>
                <td>书名</td>
                <td>作者</td>
                <td>出版社</td>
                <td>馆藏点</td>
                <td>库存</td>
                <td>单价</td>
            </tr>';
    while($arr1=mysqli_fetch_assoc($result)){
            echo"<tr>
                    <td>{$arr1['书号']}</td>".
                    "<td>{$arr1['书名']}</td>".
                    "<td>{$arr1['作者']}</td>".
                    "<td>{$arr1['出版社']}</td>".
                    "<td>{$arr1['馆藏点']}</td>".
                    "<td>{$arr1['库存']}</td>".
                    "<td>{$arr1['单价']}</td>".
                "</tr>";
    }
    echo'</table><div class="head2">
                    <a href="./borrowBook.html"><返回上级</a>
                </div>
                </div>
                </div>';
        }else{
            echo'<div class="back">
                        <div class="error">
                            <h1>借阅失败</h1>
                            根据规定，不能同时借阅相同的书
                        </div>
                        <div class="head2">
                            <a href="./borrowBook.html"><返回上级</a>
                        </div>
                </div>';
        }
    }else{
        echo'<div class="back">
                <div class="error">
                    <h1>借阅失败</h1>
                    <br>
                    账号或密码错误或者该书库存不足
                    <br>
                    或没有此书
                </div>
                <div class="head2">
                    <a href="./borrowBook.html"><返回上级</a>
                </div>
            </div>';
    }
    ?>

   
    
</body>
</html>