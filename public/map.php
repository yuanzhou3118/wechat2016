<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>CPD 欧家大众说</title>
    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        * {
            margin: 0;
            padding: 0;
            width: 100%;
            box-sizing: border-box;
        }

        img {
            width: 100%;
            display: block;
            /*bottom: 0px;*/
            /*height: 100%;*/
        }
        .zoom{
            position: absolute;
            top:24.5%;
            right: 3%;
            width: 0.6rem;
            height: 0.6rem;
        }
        .black{
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: 2;
        }
        .blackop{
            background: #999999;
            opacity:0.6;
            width: 100%;
            height: 100%;
            position: absolute;
        }
        .black img{
            z-index: 4;
            position: relative;
            width: 64%;
            margin: 50% auto;
        }
    </style>
</head>
<body>
<div class="containerIn">
    <div class="black" id="black">
        <div class="blackop"></div>
        <img src="img/a.png" class="animate1" style="display:block">
        <img src="img/b.png" class="animate2" style="display:none">
    </div>
    <img src="img/CPD-map_03.jpg" style="position: relative;top: 0px;">

    <img src="img/d.jpg" style="position: relative;" id="myImage">
</div>
<script type="text/javascript">
    var count = 0;
    var timer = setInterval(function(){
        if(count == 5) {
            clearInterval(timer);
            $('.black').css("display", "none");
        }
        if($(".animate1").css("display") == "block") {
            $(".animate1").css("display", "none");
            $(".animate2").css("display", "block");
        } else {
            $(".animate1").css("display", "block");
            $(".animate2").css("display", "none");
        }
        count++;
    }, 400);
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>