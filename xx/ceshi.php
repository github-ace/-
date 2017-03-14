<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="css/login.css"/>
        <script type="text/javascript" src="jquery/jquery.js"></script>
        <script type="text/javascript">
            
function changing(){
    document.getElementById('checkpic').src="<?php echo dirname($_SERVER['PHP_SELF']).'/captcha.php';?>?"+Math.random();
} 
        </script>
</head>
    <body>
    <img id="checkpic" onclick="changing()" src="<?php echo dirname($_SERVER['PHP_SELF']).'/captcha.php';?>" alt="ÑéÖ¤Âë"/>
    
    </body>
        </html>