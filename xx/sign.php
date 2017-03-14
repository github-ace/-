<?php
    require_once('database.php');
    
    if(isset($_POST['name'])&&isset($_POST['password'])){
      $name=$_POST['name'];
      $password=$_POST['password'];
      
      if(!empty($name)&&!empty($password)){
          if(!strpos($password," ")){
              if(strlen($password)>=6){
                $dbc=mysqli_connect(dbhost,dbuser,dbpassword,dbtable) or die('连接数据库失败');
                $query="select * from user_table where user_name='$name'";
                $data=mysqli_query($dbc,$query) or die('查询失败');
      
                if(mysqli_num_rows($data)==0){
                    $query1="insert into user_table(user_name,user_password,zc_date) values('$name','$password',now())";
                    $data1=mysqli_query($dbc,$query1) or die('插入数据失败');
                    $data=mysqli_query($dbc,$query);
                        if(mysqli_num_rows($data)==1){
                            echo "<script>alert ('注册成功');</script>";
                            header('Location:'.dirname($_SERVER['PHP_SELF']).'/login.php');
                        }
                }else{
                    echo "账户名已存在，请换一个";
                    };
                mysqli_close($dbc);
              }else{
                  echo "密码要6个字符以上";
              }
          }else{
                echo "密码不能包含空格";
                }
      }else{
          echo "用户名或密码不能为空；";
      }

    }
      
    
   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="css/sign.css"/>
        <script type="text/javascript" src="jquery/jquery1.7.js"></script>
        <script>
            $(document).ready(function () {
               $(".max-box").animate({ "top": "50px" }, 150).animate({"top":"-100px"},150).animate({"top":"0px"},150);
                $(".slide-block").toggle(
                function () {
                    $(".slide").animate({ "left": "21px" }, "1000", function () { document.getElementById("password").setAttribute("type", "text") })
                },
                function () {
                    $(".slide").animate({ "left": "1px" }, "1000", function () { document.getElementById("password").setAttribute("type", "password") })
                }
                )

            })
        </script>
        <script>
            $(document).ready(function () {
                $('#password').focus(function () {
                    document.getElementById("password").setAttribute("type", "password");
                    $(".slide").animate({ "left": "1px" }, "1000");
                })
            })
        </script>
        <title>注册——终期实训</title>
    </head>
    <body>
        
          <h1>注册</h1>
          <hr/>
        <div class="max-box">
            <form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="name">
                    <label for="name">用户名</label>
                    <input type="text" name="name" value="" placeholder="用户名"/>
                </div>
                <div class="password">
                    <label for="password">密-码</label>
                    
                    <input id="password" type="password" name="password" value="" placeholder="至少6个字符无空格" />
                    
                    <div class="slide-border">
                        <div class="slide-block">
                            <span>Y</span>
                            <div class="slide">
                        
                            </div>
                            <span>N</span>
                        </div>
                        <span class="text">显示密码</span>
                    </div>
                </div>
                <div class="sign" onclick="document.getElementById('form').submit()">注册</div>
            </form>
        </div>
    </body>
</html>
