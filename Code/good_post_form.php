<?php
    //开启会话
	session_start(); 

    // 登陆状态判定
	if($_SESSION['Passed'] == false){
		header('content-type:text/html;charset=utf-8');
        $url='exit.php';
		echo "<script>window.location.href='$url';</script>;"; 
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta charset="utf-8">
        <title>商品发布界面</title>
        <style  type="text/css">
            se{background-color: #FFEBCD}
            .head1{
                height:30px;
                background-color:#9F4300;
                filter:opacity(70%);
                color:#FFFFFF;
                /* color: #FFFFFF;
                padding-top: 2px;
                padding-left:70%;
                font-size: 24px;
                font-family:  "方正寂地简体"; */
            }

            .link1:link{
                color: rgb(240, 3, 7);
                text-decoration: none;
            }
            .link1:visited{
                color: rgb(240, 3, 7);
                text-decoration: none;
            }
            .link2:link{
                color: 	#EEAD0E;
                text-decoration: none;
            }
            .link2:visited{
                color: 	#EEAD0E;
                text-decoration: none;
            }
    </style>
    <link href="css/demo.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="js/jquery.fancy-textbox.js" type="text/javascript"></script>
    <link href="css/fancy-textbox.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        $(document).ready(function () {
            $('input').ftext();
        });
        
    </script> 
    <script type="text/javascript">
        function imgPreview(fileDom){
            //判断是否支持FileReader
            if (window.FileReader) {
                var reader = new FileReader();
            } else {
                alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
            }
    
            //获取文件
            var file = fileDom.files[0];
            var imageType = /^image\//;
            //是否是图片
            if (!imageType.test(file.type)) {
                alert("请选择图片！");
                return;
            }
            //读取完成
            reader.onload = function(e) {
                //获取图片dom
                var img = document.getElementById("preview");
                //图片路径设置为读取的图片
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
</head>
<body>
    <div class="head1">
		<a href="index.php">
				<button class="butn">黑市首页</button></a>
				你好，<?php echo $_SESSION['user_name'];?>  	
				<a class="link2" href="exit.php">[注销]</a>
			<span style="color: #FFFFFF;padding-left:50%;font-size: 24px;">Let's start a shopping!</span>
        </div>
        
    <div class="ppnl">
        <h1>
            Please publish your products.</h1>
        <h2>
            Fill in the information below about the goods you want to publish.</h2>
    </div>

<form method="POST" action="good_post.php" enctype="multipart/form-data">
    <div align="center" style="background:#FFEBCD"><br><br><br><br><br><textarea rows="5" cols="150" placeholder="请简单地描述一下你的商品"
    name="good_descript" required></textarea></div>
    <div class="pn1">
        <ul class="list clearfix">
            <li>
                <input id="n" type="text" data-animation="rotate-3d-left" id="rotate-3d-left" data-label="商品名称"
                    name="good_name" required/></li>
            <li>
                <input id="n" type="number" data-animation="rotate-3d-left" id="rotate-3d-left" data-label="商品价格"  
                name="good_price" id="price" required/>
            </li>
            <li>
                <select class="styled-select" name="good_type" id="good_type">
                    <option value="0">书籍</option>
                    <option value="1">电子产品</option>
                    <option value="2">学习工具</option>
                    <option value="3">生活用品</option>
                    <option value="4">其他</option>
                </select></li>
        </ul>
        
    </div>
    <div class="pn2">
        <ul class="list clearfix">
            <li>
                <input id="n" type="text" data-animation="rotate-3d-left" id="rotate-3d-left" data-label="联系方式"
                    name="good_contact" placeholder="微信号/QQ/邮箱/电话" required/></li>
            <li>
                <input id="n" type="text" data-animation="rotate-3d-left" id="rotate-3d-left" data-label="新旧程度" placeholder="几成新"
                    name="old_new" required/></li>
            <li>
               <!--  <input type="file" name="good_image">
                <button type="submit">发布</button> -->
                <input id="m" type="file" name="good_image" style="width:80%" onchange="imgPreview(this)" required/></li>
            </ul>
    </div>
    <div class="pn3">
        <ul class="list clearfix">
            <li>
                <input id="n" type="number" data-animation="rotate-3d-left" id="rotate-3d-left" data-label="商品发布天数" min="3" max="30"
                    name="post_time" id="post_time" required/></li>
            <li>
                <input id="n" type="text" data-animation="rotate-3d-left" id="rotate-3d-left" data-label="商品所在地"
                name="good_address"    required/></li>
            <li>
                <button type="submit">发布商品</button>
            </li>
        </ul>
    </div>
</form>
    <div align="center" style="background:#FFEBCD">
        <br><br><br><br>
        <img style="margin:0 auto;" id="preview"/>
    </div>
</body>
</html>