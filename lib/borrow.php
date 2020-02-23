<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./ico/借阅记录.png">
    <title>借阅查询结果</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        pre{
            margin-top:40px;
            font-size:20px;
            text-align:center;
        }
        body{
            min-height: 100vh;
            min-width: 100vw;
            background-image: url("./pic/02.jpg");
            background-repeat:no-repeat ;
            background-size:100% 100%  ;
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    
</head>
<body>

    <?php
    //（1）设置接收变量
    $stuNo=$_POST["stuNo"];
    $password=$_POST["password"];
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
    //2、select
    $sql1="select stu.姓名 as 读者,sb.书号,book.书名,book.作者,book.出版社,sb.借阅日期,date_add(sb.借阅日期,interval 30 Day) as 归还日期 from sb,sap,book,stu where sap.学号='{$stuNo}' and sap.密码='{$password}' and sb.学号=sap.学号 and book.书号=sb.书号 and stu.学号=sap.学号";
    $result1=mysqli_query($link,$sql1);
    //从结果集中获取一行数据,并作为枚举数组返
    echo'<div class="back"><div class="head1"><h1>借阅查找结果</h1></div><div class="table_style"><table border="1" class="table"><tr><td>读者</td><td>书号</td><td>书名</td><td>作者</td><td>出版社</td><td>借阅日期</td><td>归还日期</td></tr>';
    while($arr1=mysqli_fetch_assoc($result1)){
        echo"<tr><td>{$arr1['读者']}</td>".
        "<td>{$arr1['书号']}</td>".
        "<td>{$arr1['书名']}</td>".
        "<td>{$arr1['作者']}</td>".
        "<td>{$arr1['出版社']}</td>".
        "<td>{$arr1['借阅日期']}</td>".
        "<td>{$arr1['归还日期']}</td>".
        "</tr>";
    }
    echo'</table><div class="head2">
    <a href="./borrow.html"><返回上级</a>
</div></div></div>';
    // var_dump($result);
    //手动释放result变量
    mysqli_free_result($result1);
    ?>
    
    
</body>
</html>