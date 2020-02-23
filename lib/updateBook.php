<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./ico/表单更新.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>添加图书</title>
    <style type="text/css">
        body{
            min-height: 100vh;
            min-width: 100vw;
            background-image:url("./pic/panorama-1993645_1920.jpg");
            background-size:cover;
            background-repeat:no-repeat;
        }
        .f1{
            text-align:center;
            font-size:30px;
        }
        .f1 h2{
            color:red;
        }
        .f2{
            text-align:center;
            font-size:30px;
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
            background: rgba(255, 255, 255, 0.8);
            /* height: 680px; */
            padding: 50px 40px;
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
    $bookNo=$_POST["bookNo"];
    $book=$_POST["book"];
    $author=$_POST["author"];
    $chuban=$_POST["chuban"];
    $local=$_POST["local"];
    $num=$_POST["num"];
    $price=$_POST["price"];
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
    //1、update
    $sql1="update book set 书名='{$book}',作者='{$author}',出版社='{$chuban}',馆藏点='{$local}',库存='{$num}',单价='{$price}' where 书号='{$bookNo}'" ;
    $result1=mysqli_query($link,$sql1);
    if(!($result1)){
        echo'<div class="back"><div class="f1">';
        echo"<h2>更新失败!</h2>";
        echo"<h5>可能是没有这本书，或者图书信息不全</h5>";
        echo'</div></div>';
    }else{
        echo'<div class="back"><div class="f2">';
        echo"<h2>更新成功啦!结果如下</h2>";
        echo'</div>';
        $sql2="select* from book where 书号='{$bookNo}' and 书名='{$book}'";
        $result2=mysqli_query($link,$sql2);
        echo'<div class="table_style">
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
        while($arr1=mysqli_fetch_assoc($result2)){
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
    }
    echo'</table>
            <div class="head2">
                <a href="./updateBook.html"><返回上级</a>
            </div></div>';
    mysqli_free_result($result2);
    ?>
    

    
</body>
</html>