<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
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
            box-sizing: border-box;
        }

        img {
            width: 100%;
            display: block;
        }

        form {
            width: 100%;
            display: block;
            position: absolute;
            height: 100%;
        }

        .box1 {
            position: absolute;
            top: 19%;
            left: 18%;
        }

        .box2 {
            position: absolute;
            top: 50%;
            left: 18%;
        }
        .box1 input[type=checkbox], .box1 input[type=radio],
        .box2 input[type=checkbox], .box2 input[type=radio]{
            width:18px;
            height:18px;
        }

        .box3 {
            position: absolute;
            top: 35%;
            left: 25%;
            width: 52%;
        }

        .box4 {
            position: absolute;
            top: 66%;
            left: 25%;
            width: 52%;
        }
        .box3 input,.box4 input {
            width:3.3rem;
            height: 0.6rem;
        }
    </style>
</head>
<body>
<div class="containerIn">
    <img src="img/CPD_03.jpg" style="position: absolute;height: 100%;">
    <form>
        <div class="box1">
            <input type="radio" name="optionsRadios" id="optionsRadios1" checked>

        </div>
        <div class="box2">

            <input type="radio" name="optionsRadios" id="optionsRadios2">

        </div>
        <div class="box3">
            <input type="text" name="optionsRadios" id="optionsRadios1"
                    checked>

        </div>
        <div class="box4">

            <input type="text" name="optionsRadios" id="optionsRadios2">

        </div>
    </form>
</div>
</body>
</html>