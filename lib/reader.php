<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./ico/读者管理.png">
    <title>读者注册</title>
    
    <style type="text/css">
        body{
            background-image:url("./pic/plouzane.jpg");
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
            font-size:40px;
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
    </style>
</head>
<body>
    <?php
    //（1）设置接收变量
    $stuNo=$_POST["stuNo"];
    $stuName=$_POST["stuName"];
    $sGender=$_POST["sGender"];
    $depart=$_POST["depart"];
    $stuTel=$_POST["stuTel"];
    $password1=$_POST["password1"];
    $password2=$_POST["password2"];
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
    
    // if($stuNo==null || $stuName==null || $password1==null || $password2==null || $password1!=$password2){
    //     echo'<div class="back"><div class="f1">';
    //     echo"<h2>注册失败!</h2>";
    //     echo"<h5>可能是已经注册过了,或者未按规范填写注册表，或者两次密码不相同</h5>";
    //     echo'</div></div>';
    // }else{
    //1、insert
    $sql1="insert into stu(学号,姓名,性别,单位,联系方式) values('$stuNo','$stuName','$sGender','$depart','$stuTel')";
    $result1=mysqli_query($link,$sql1);
    $sql2="insert into sap(学号,密码) values('$stuNo','$password1')";
    $result2=mysqli_query($link,$sql2);
    if($result2){
        echo'<div class="back"><div class="f2">';
        echo"<h2>注册成功啦!</h2><br>";
        echo'</div><div class="head2">
        <a href="./reader.html"><返回上级</a>
        </div></div>';
    }else{
        echo'<div class="back">
                <div class="f1">';
                echo"<h2>注册失败!</h2>";
                echo"<h5>该学号已经被注册过了</h5>";
                echo'</div>
                <div class="head2">
                    <a href="./reader.html"><返回上级</a>
                </div>
            </div>';
    }
    ?>
    


</body>
</html>