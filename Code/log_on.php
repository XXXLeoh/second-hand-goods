<?php
    session_start();

    // 登陆脚本
    include('Class_Users.php');
    $user = new Users();
   /*  重点：$_session变量是一类全局变量，可以与后端进行对话（php里保存的变量可以用在html里），
        而且，$_session变量会跟随用户的网页一起移动，到了另一个页面里，仍旧可以使用这些变量
        有了$_session以后，我们就能实现更多与前端的连接
         */
    // 如果尚未定义Passed的session对象，就定义一个，值为false表示还未通过身份验证
    $_SESSION['Passed'] = false;

    if($_SESSION['Passed'] == false){
        //检查用户是否已经输入过数据
        if(!isset($_POST['username']) || $_POST['username'] == ""){
            $errmsg = "请输入   用户名/邮箱 和密码";
        }
        else{
            // 读取从表单获取的数据
            $username = $_POST['username'];
            $password = $_POST['password'];

            //开始验证是输入的 username 是否为用户名
            if($user->is_user_name($username)){
                if($user->is_user_password($password)){
                    $_SESSION['Passed'] = true;
                    $_SESSION['user_id'] = $user->get_user_id();
                }else{
                    $errmsg = "密码不正确";
                }
            }// 验证user是否为邮箱
            elseif($user->is_user_email($username)){
                if($user->is_user_password($password)){
                    $_SESSION['Passed'] = true;
                    $_SESSION['user_id'] = $user->user_id;
                }else{
                    $errmsg = "密码不正确";
                }
            }else{
                $errmsg = "请输入正确的用户名或邮箱";
            }
        }
    }
    // 如果登陆不成功，则重新打印出登陆表单
    if($_SESSION['Passed'] == false){
?>

<!doctype html>
<style>
    html, body {
        height: 100%;
    }

    body {
        font: 12px '微软雅黑', 'Trebuchet MS', Arial, Helvetica;
        margin: 0;
        background-color: #d9dee2;
        background-image: -webkit-gradient(linear, left top, left bottom, from(#ebeef2), to(#d9dee2));
        background-image: -webkit-linear-gradient(top, #ebeef2, #d9dee2);
        background-image: -moz-linear-gradient(top, #ebeef2, #d9dee2);
        background-image: -ms-linear-gradient(top, #ebeef, #d9dee2);
        background-image: -o-linear-gradient(top, #ebeef2, #d9dee2);
        background-image: linear-gradient(top, #ebeef2, #d9dee2);
    }

    #login {
        background-image: url(img/%E7%9B%90%E7%B3%BB%E6%98%9F%E7%90%83%E8%83%8C%E6%99%AF%E5%9B%BE1.jpg);
        height: 240px;
        width: 400px;
        margin: -150px 0 0 -230px;
        padding: 30px;
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 0;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        -webkit-box-shadow: 0 0 2px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 0, 0, .2), 0 3px 0 #fff, 0 4px 0 rgba(0, 0, 0, .2), 0 6px 0 #fff, 0 7px 0 rgba(0, 0, 0, .2);
        -moz-box-shadow: 0 0 2px rgba(0, 0, 0, 0.2), 1px 1px 0 rgba(0, 0, 0, .1), 3px 3px 0 rgba(255, 255, 255, 1), 4px 4px 0 rgba(0, 0, 0, .1), 6px 6px 0 rgba(255, 255, 255, 1), 7px 7px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 0, 0, .2), 0 3px 0 #fff, 0 4px 0 rgba(0, 0, 0, .2), 0 6px 0 #fff, 0 7px 0 rgba(0, 0, 0, .2);
    }

        #login:before {
            content: '';
            position: absolute;
            z-index: -1;
            border: 1px dashed #ccc;
            top: 5px;
            bottom: 5px;
            left: 5px;
            right: 5px;
            -moz-box-shadow: 0 0 0 1px #fff;
            -webkit-box-shadow: 0 0 0 1px #fff;
            box-shadow: 0 0 0 1px #fff;
        }

    h1 {
        text-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0px 2px 0 rgba(0, 0, 0, .5);
        text-transform: uppercase;
        text-align: center;
        color: #666;
        margin: 0 0 30px 0;
        letter-spacing: 4px;
        font: normal 26px/1 Verdana, Helvetica;
        position: relative;
    }

        h1:after, h1:before {
            background-color: #777;
            content: "";
            height: 1px;
            position: absolute;
            top: 15px;
            width: 120px;
        }

        h1:after {
            background-image: -webkit-gradient(linear, left top, right top, from(#777), to(#fff));
            background-image: -webkit-linear-gradient(left, #777, #fff);
            background-image: -moz-linear-gradient(left, #777, #fff);
            background-image: -ms-linear-gradient(left, #777, #fff);
            background-image: -o-linear-gradient(left, #777, #fff);
            background-image: linear-gradient(left, #777, #fff);
            right: 0;
        }

        h1:before {
            background-image: -webkit-gradient(linear, right top, left top, from(#777), to(#fff));
            background-image: -webkit-linear-gradient(right, #777, #fff);
            background-image: -moz-linear-gradient(right, #777, #fff);
            background-image: -ms-linear-gradient(right, #777, #fff);
            background-image: -o-linear-gradient(right, #777, #fff);
            background-image: linear-gradient(right, #777, #fff);
            left: 0;
        }

    fieldset {
        border: 0;
        padding: 0;
        margin: 0;
    }

    #inputs input {
        background: #f1f1f1 url(http://www.srcfans.com/jscode/img/201506/images/login-sprite.png) no-repeat;
        padding: 15px 15px 15px 30px;
        margin: 0 0 10px 0;
        width: 353px; /* 353 + 2 + 45 = 400 */
        border: 1px solid #ccc;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
        -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
        box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    }

    #username {
        background-position: 5px -2px !important;
    }

    #password {
        background-position: 5px -52px !important;
    }

    #inputs input:focus {
        background-color: #fff;
        border-color: #e8c291;
        outline: none;
        -moz-box-shadow: 0 0 0 1px #e8c291 inset;
        -webkit-box-shadow: 0 0 0 1px #e8c291 inset;
        box-shadow: 0 0 0 1px #e8c291 inset;
    }

    #actions {
        margin: 25px 0 0 0;
    }

    #submit {
        background-color: #ffb94b;
        background-image: -webkit-gradient(linear, left top, left bottom, from(#fddb6f), to(#ffb94b));
        background-image: -webkit-linear-gradient(top, #fddb6f, #ffb94b);
        background-image: -moz-linear-gradient(top, #fddb6f, #ffb94b);
        background-image: -ms-linear-gradient(top, #fddb6f, #ffb94b);
        background-image: -o-linear-gradient(top, #fddb6f, #ffb94b);
        background-image: linear-gradient(top, #fddb6f, #ffb94b);
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        text-shadow: 0 1px 0 rgba(255,255,255,0.5);
        -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
        -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
        border-width: 1px;
        border-style: solid;
        border-color: #d69e31 #e3a037 #d5982d #e3a037;
        float: left;
        height: 35px;
        padding: 0;
        width: 120px;
        cursor: pointer;
        font: bold 15px Arial, Helvetica;
        color: #8f5a0a;
    }

        #submit:hover, #submit:focus {
            background-color: #fddb6f;
            background-image: -webkit-gradient(linear, left top, left bottom, from(#ffb94b), to(#fddb6f));
            background-image: -webkit-linear-gradient(top, #ffb94b, #fddb6f);
            background-image: -moz-linear-gradient(top, #ffb94b, #fddb6f);
            background-image: -ms-linear-gradient(top, #ffb94b, #fddb6f);
            background-image: -o-linear-gradient(top, #ffb94b, #fddb6f);
            background-image: linear-gradient(top, #ffb94b, #fddb6f);
        }

        #submit:active {
            outline: none;
            -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
            -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
        }

        #submit::-moz-focus-inner {
            border: none;
        }

    #actions a {
        color: #3151A2;
        float: right;
        line-height: 35px;
        margin-left: 10px;
    }

    #back {
        display: block;
        text-align: center;
        position: relative;
        top: 60px;
        color: #999;
    }
	input::-webkit-input-placeholder {
        /* placeholder颜色  */
        color: #aab2bd;
        /* placeholder字体大小  */
        font-size: 12px;
        /* placeholder位置  */
        text-align: left;
    }
</style>
<html>
<head>
    <meta charset="utf-8">
    <title>中大“黑市”——登录</title>
    <style type="text/css">
        body {
            background-image: url(img/盐系星球背景图.jpg);
            height: 500px;
            margin: 0px
        }

        #head {
            height: 30px;
            background-color: #9F4300;
            color: #FFFFFF;
            filter: opacity(70%);
            padding-top: 2px;
            padding-left: 70%;
            font-size: 24px;
            font-family: "方正寂地简体";
        }

        #banner {
            width: 1280px;
            height: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        #content1 {
            filter: opacity(70%);
            width: 1280px;
            height: 650px;
            margin-left: auto;
            margin-right: auto;
            background-color: #FFFFFF;
            text-align: center;
            padding-top: 100px;
        }
    </style>

</head>


<body>
<div id="head">Let's start a shopping !</div>
    <form id="login" opacity: 0.5 method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <h1>登 陆</h1>
        <p><?php echo($errmsg);?></p>
        <fieldset id="inputs">
          <input id="username" type="text" placeholder="Username or Email_address" name="username" autofocus required/>
          <input id="password" type="password" placeholder="Password" name="password" required/>
        </fieldset>
        <fieldset id="actions">
            <input type="submit" id="submit" value="登陆"  >
            <a href="">忘记密码?</a><a href="log_in.php">注册</a>
        </fieldset>
    </form>
    <br><br>
    <div style="text-align:center;clear:both">
    </div>
</body>

</html>



<?php
        exit("");
    }
    else{
        // 跳转到主页
        $_SESSION['user_name'] = $user->get_user_name();
        
//        echo "<script>alert('stop');</script>";

        header('content-type:text/html;charset=utf-8');
        if($user->get_user_style() == 0){
            $url='index.php';
        }else{
            $url = 'inbox.php';
        }
        echo "<script>window.location.href='$url';</script>;";
    } 
?>