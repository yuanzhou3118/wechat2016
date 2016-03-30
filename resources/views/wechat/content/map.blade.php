<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>CPD 欧家大众说</title>
    <script type="text/javascript" src="{{URL::asset('assets/javascript/rem.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
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
            width: 17%;
            /*height: 100%;*/
            position: relative;
            z-index: 2;
            /*top:57%;*/
            left:42%;
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
            /*margin: 50% auto;*/
        }
    </style>
</head>
<body>
<div class="containerIn">

    <img src="{{URL::asset('assets/images/CPD-map_03.jpg')}}" style="position: relative;top: 0px;">
    <div class="black" id="black">
        <img src="{{URL::asset('assets/images/a.png')}}" class="animate1" style="display:block">
        <img src="{{URL::asset('assets/images/b.png')}}" class="animate2" style="display:none">
    </div>
    <img src="{{URL::asset('assets/images/d.jpg')}}" style="position: relative;" id="myImage">
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="{{URL::asset('assets/javascript/jquery-1.12.2.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="{{URL::asset('assets/javascript/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        var count = 0;
        var timer = setInterval(function(){

            if($(".animate1").css("display") == "block") {
                $(".animate1").css("display", "none");
                $(".animate2").css("display", "block");
            } else {
                $(".animate1").css("display", "block");
                $(".animate2").css("display", "none");
            }
            count++;
        }, 400);
    });
</script>
</body>
</html>