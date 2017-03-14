<?php
session_start();
if(isset($_COOKIE['user_id'])||isset($_SESSION['user_id'])){
    header('location:'.dirname($_SERVER['PHP_SELF']).'/index.php');
}
require_once('database.php');
$dbc=mysqli_connect(dbhost,dbuser,dbpassword,dbtable);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
	<!--此处样式一半使用header.css；2016/11/24-->
        <link rel="stylesheet" type="text/css" href="css/header.css"/>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
        <script type="text/javascript" src="jquery/jquery.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
        <title>登录|XX</title>
    </head>
    <body>
       <div id="header" class="header">
            <div id="search" class="search">
                <form method="get" autocomplete="off"  action="<?php echo dirname($_SERVER['PHP_SELF']).'/search.php';?>">
                    <input class="search-input" type="text" placeholder="输入关键字，立即搜索"/>
                    <input class="search-submit" type="submit" value="==>>"/>
                </form>
            </div>
            <div id="right" class="right">
                <a href="<?php echo dirname($_SERVER['PHP_SELF']).'/sign.php';?>" title="注册"><button class="right-button">注册</button></a>
            </div>
       </div>
       <div class="yanzheng">
            <form method="post" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input id="user_name" class="user_name" type="text" name="user_name" placeholder="用户名" value="<?php echo isset($_POST['user_name'])?$_POST['user_name']:'';?>"/>
                <?php
                    if(isset($_POST['user_name'])){
                        $user_name=$_POST['user_name'];
                        
                        $query="select * from user_table where user_name='$user_name'";
                        $data=mysqli_query($dbc,$query);
                        $row=mysqli_fetch_array($data);
                        //表单提交后的查询
                        if($row['error_time']>2){
                            //密码错误次数超过2次，需要验证码
                            if(isset($_POST['user_password'])&&isset($_POST['captcha'])){
                                if(!empty($_POST['user_password'])){
                                    if(!empty($_POST['captcha'])){
                                        if($_POST['captcha']==$_SESSION['captcha']){
                                            if($row['user_password']==$_POST['user_password']){
                                                $query="update user_table set error_time='1' where user_name='$user_name'";
                                                $data=mysqli_query($dbc,$query);
                                                header('location:'.dirname($_SERVER['PHP_SELF']).'/index.php');
                                                }else{
                                                    echo "<span id='alert' class='alert'>密码错误</span>";
                                                    }
                                            }else{
                                                echo "<span id='alert' class='alert'>验证码错误</span>";
                                                }
                                         }else{
                                            echo "<span id='alert' class='alert'>验证码不能为空</span>";
                                            }
                                    }else{
                                        echo "<span id='alert' class='alert'>密码不能为空</span>";
                                        }
                                }
                            }else{
                                //不需要验证码
                                if(isset($_POST['user_password'])){
                                    if(!empty($_POST['user_password'])){
                                        if($row['user_password']==$_POST['user_password']){
                                                $query="update user_table set error_time='1' where user_name='$user_name'";
                                                $data=mysqli_query($dbc,$query);
                                                header('location:'.dirname($_SERVER['PHP_SELF']).'/index.php');
                                                }else{
                                                    $query="update user_table set error_time='".($row['error_time']+1)."'where user_name='$user_name'";
                                                    //echo ($row['error_time']+1);
                                                    //不需要验证码的$no_data
                                                    $no_data=mysqli_query($dbc,$query);
                                                    echo "<span id='alert' class='alert'>密码错误</span>";
                                                    }
                                    }else{
                                        echo "<span id='alert' class='alert'>密码不能为空</span>";
                                    }
                                }
                                }
                        //到此结束

                        //客户端的显示部分
                        if(mysqli_num_rows($data)==1){
                            echo "<input id='user_password' class='user_password' type='password' name='user_password' placeholder='密码'/>";
                            
                            if($row['error_time']>2){
                                echo "<input id='captcha' class='captcha' type='text' name='captcha' placeholder='验证码'/>";
                                echo "<img alt='验证码' id='cap' class='cap' onclick='change()' src='".dirname($_SERVER['PHP_SELF'])."/captcha.php' />";
                                //js代码，更新验证码
                                echo "<script type='text/javascript'>";
                                echo "function change(){
                                    document.getElementById('cap').src='".dirname($_SERVER['PHP_SELF'])."/captcha.php?'+Math.random();".
                                '}';
                                echo "</script>";
                            }
                        }else{
                            echo "<span id='alert' class='alert'>用户名不存在！</span>";
                        }
                    }
                    //到此结束
                ?>
                <input id="submit" class="submit" type="submit" value="确定"/>
            </form>
       </div>
    </body>
</html>
