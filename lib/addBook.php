<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./ico/图书录入.png">
    <title>添加图书</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{
            background-image:url("./pic/forest-931706_1920.jpg");
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
    <!-- 
        (1)数据库配置信息
        $db_host="localhost";                         主机名
        $db_port="3306";                              端口号
        $db_user="root";                              用户名
        $db_pass="root";                              密码
        $db_name="itcast";                            数据库名字
        $charset="utf8";                              字符集
        (2)php连接数据库
        $link=@mysqli_connect($db_host.":".$db_port,$db_user,$db_pass);
        加入@屏蔽报错信息
        var_dump($link);                            连接成功返回mysql连接对象，否则返回false
        (3)die();                                 （如果连接失败）终止程序向下进行
        (4)mysqli_close($link)                      关闭连接通道
        (5)mysqli_select_db(mysql)                  选择数据库
        (6)mysqli_set_charset($link,$charset)       设置客户端字符集，成功返回true，否则返回false
        (7)执行各种sql语句
            mysqli_query()仅对select,show,describe成功返回结果集对象，失败返回false
        (8)释放与结果集相关的内存
            1,手动释放
            mysqli_free_result(mysql_result)
            2,自动释放
            等到网页执行完毕，自动释放
    -->



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
    //1、insert
    $insert="insert into book(书号,书名,作者,出版社,馆藏点,库存,单价)values('$bookNo','$book','$author','$chuban','$local','$num','$price')";
    $res_insert=mysqli_query($link,$insert);
    if(!($res_insert)){
        echo'<div class="back">
                <div class="f1">';
        echo"       <h2>添加失败</h2>";
        echo"       <h5>数据库已经有此书的信息</h5>";
        echo'   </div>
                <div class="head2">
                    <a href="./addBook.html"><返回上级</a>
                </div>
            </div>';
    }else{
        //2、select
        $sql="select* from book where 书号='$bookNo' and 书名='$book'";
        $result=mysqli_query($link,$sql);
        echo'<div class="back">
                <div class="f2">';
        echo"       <h2>添加成功,结果如下</h2>";
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
                        <a href="./addBook.html"><返回上级</a>
                    </div>
                    </div>
                    </div>';
            
        mysqli_free_result($result);
    }
    
    
    ?>
    


</body>
</html>