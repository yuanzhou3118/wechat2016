<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>CPD 欧家大众说</title>
    <script type="text/javascript" src="{{URL::asset('assets/javascript/rem.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/javascript/jquery-1.12.2.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/javascript/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html,body{
            height:100%;
        }
        img {
            width: 100%;
            display: block;
        }
        .containerIn{
            width: 100%; height:100%;
        }
        input[type=checkbox], input[type=radio] {
            display: block;
            width: 15px;
            height: 15px;
        }
        form {
            width: 100%;
            display: block;
            position: absolute;
            height: 100%;
            left:0;top:0;
        }

        .box1 {
            position: absolute;
            top: 18.9%;
            left:18%;
            z-index:20;
        }

        .box2 {
            position: absolute;
            top: 49.5%;
            left:18%;
            z-index:20;
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

        .box3 input, .box4 input {
            width: 3.3rem;
            height: 0.6rem;
        }

        .bind_sub {
            width: 3.3rem;
            height: 0.8rem;
            position: absolute;
            top: 81%;
            left: 24%;

        }
        p{
            color: black;
            font-size: 0.19rem;
            position: absolute;
            line-height: 0.33rem;
        }
        .p1{
            top: 45%;
            left: 15%;
        }
        .p2{
            top: 55%;
            left: 15%;
        }
        ul{
            color: black;
            font-size: 0.19rem;
            position: absolute;
            line-height: 0.3rem;
            top: 68%;
            left: 19%;
        }
    </style>
</head>
<body>
<div class="containerIn">
    <img src="{{URL::asset('assets/images/CPD_03.jpg')}}" style="position: absolute;height: 100%;">
    <form>
        {{csrf_field()}}
        <div class="box1">
            <input title="" type="radio" name="optionsRadios" id="optionsRadios1" checked value="1">
        </div>
        <div class="box2">
            <input title="" type="radio" name="optionsRadios" id="optionsRadios2" value="2">
        </div>
        <div class="box3">
            <input title="" type="text" name="employee_type" id="employee_type">
        </div>
        <div class="box4">
            <input title="" type="text" name="id_card" id="id_card">
        </div>
        <a onclick="getSample()" class="bind_sub"></a>
    </form>
</div>
<div style="display: none;" class="bind_success">
    <img src="{{URL::asset('assets/images/CPD_02.jpg')}}" style="position: absolute;bottom: 0px;height: 100%;">
    <p class="p1"><span id="cnname"></span>，欢迎您参加<br>
        “2016欧莱雅中国大众化妆品部销售及经销商年会”，<br>
        请及时关注会议相关动态。</p><br>
    <p class="p2"><span id="enname"></span>, welcome to attend<br>
        “2016 CPD Commercial & Distributor Conference”,<br>
        please focus on the relevant information in time.</p>
    <ul>
        <li>会议时间: 2016年4月20号</li>
        <li>  会议地点: 三亚湾红树林度假世界</li>
        <li> 会议地址: 海南省三亚市凤凰路155号</li><br>

        <li>   Date: Apr 20th, 2016</li>
        <li>  Place: Mangrove Tree Resort World Sanya Bay</li>
        <li>  Address: No.155, Fenghuang Rd. Sanya, Hainan</li>
    </ul>
</div>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function getSample() {
        var employee_type = $('input:radio[name="optionsRadios"]:checked').val();

        $.ajax({
            type: "post",
            url: '{{URL::route('wechat.binding.do')}}',
            data: {
                id: '{{$id or 0}}',
                sign: '{{$sign or ''}}',
                employee_type: employee_type,
                id_card: employee_type == 1 ? $.trim($('#employee_type').val()) : $.trim($('#id_card').val())
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.result == 0) {
                    alert("绑定失败");
                }
                if (data.result == 1) {
                    $('#cnname').text(data.cnname);
                    $('#enname').text(data.enname);
                    $('.containerIn').css('display', 'none');
                    $('.bind_success').css('display', 'block');
                }
                if (data.result == 2) {
                    alert("用户不存在");
                }
                if (data.result == 3) {
                    alert("已经绑定过了");
                }
            }
        });
    }

    function bind_success(data) {

        $('#cnname').text(data.cnname);
        $('#enname').text(data.enname);
        $('.containerIn').css('display', 'none');
        $('.bind_success').css('display', 'block');
    }
</script>

</body>
</html>