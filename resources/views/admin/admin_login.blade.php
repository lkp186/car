<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理员登录</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/admin_login_css/normalize.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/admin_login_css/demo.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/admin_login_css/component.css')}}" />
    <link rel="stylesheet" href="{{asset('public/css/home.css')}}">
    <script type="text/javascript" src="{{asset('public/js/html5.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/jquery.js')}}"></script>
    <script src="{{asset('public/js/sweet-alert.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/css/sweet-alert.css')}}">
</head>
<body>

<div id="header" style="z-index: 999;position: relative;opacity: 0.85">
    <nav class="navbar navbar-default " role="navigation" >
        <div class="container-fluid">
            <div class="navbar-header"style="height: 90px;">
                <a class="navbar-brand-1" style="font-family: 华文隶书;font-size: 6em;margin-top: 20px;text-decoration: none;" href="{{url('home')}}">Share-Car</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav  navbar-nav menu-1" style="margin-top: 36px;font-size: 1.5em;" >
                    <li id="li"><a href="{{url('search')}}">订单查询</a></li>
                    <li id="li"><a href="{{url('order')}}">在线下单</a></li>
                    <li id="li"><a href="{{url('location')}}">网点分布</a></li>
                    <li id="li"><a href="{{url('help')}}">新人指引</a></li>
                    <li id="li"><a href="{{url('about')}}">关于我们</a></li>
                </ul>
                @yield('admin-login')
            </div>
        </div>
    </nav>
</div>

<div class=" demo-2" style="background-image: url({{asset('public/image/demo-2-bg.jpg')}});margin-top: -112px;position: relative">
    <div class="content">
        <div id="large-header" class="large-header" style="background-image: url({{asset('public/image/demo-2-bg.jpg')}});">
            <canvas id="demo-canvas"></canvas>
            <div class="main-title" style="margin-top: auto;font-size: 50px;">
                <label class="control-label">管理员登录</label>

                <form class="form-horizontal">
                    <div class="form-group" style="width: 800px;">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="text" name="number" class="form-control" id="number" placeholder="账号">
                        </div>
                        <div class="col-sm-3" style="height: 34px;">
                            <label id="number_label" style="font-size: 20px;color: snow;display: none;"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="password" name="password" class="form-control" id="password" placeholder="密码">
                        </div>
                        <div class="col-sm-3" style="height: 34px;">
                            <label id="password_label" style="font-size: 20px;color: snow;display: none;"></label>
                        </div>
                    </div>

                    <div class="form-group" >
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="password" class="form-control" id="code" placeholder="验证码">
                        </div>

                        <div class="col-sm-3 " style="margin-top: -24px;">
                            <img src="{{url('home/login/code')}}" onclick="this.src='{{url('home/login/code')}}?'+Math.random()">
                        </div>
                        <div class="col-sm-3 " style="height: 34px;"><label id="code_label" style="font-size: 20px;color: snow;display: none;"></label></div>
                    </div>

                    <div class="form-group">
                        <div class=" col-sm-3 col-sm-offset-3">
                            <button type="button" id="login" class="btn btn-warning btn-block">登录</button>
                        </div>
                        <div class=" col-sm-3">
                            <button type="reset" class="btn btn-warning btn-block">重置</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#number').blur(function () {
            if($('#number').val()==''){
                $('#number_label').html('账号不能为空').css('display','block');
            }else {
                $('#number_label').html('').css('display','none');
            }
        });
        $('#password').blur(function () {
            if($('#password').val()==''){
                $('#password_label').html('密码不能为空').css('display','block');
            }else {
                $('#password_label').html('').css('display','none');
            }
        });
        $('#code').mouseleave(function () {
            if($('#code').val()==''){
                $('#code_label').html('验证码不能为空').css('display','block');
            }else {
                $('#code_label').html('验证码正确').css('display','none');
                $.ajax({
                    url:"{{url('admin/login/checkCode')}}",
                    type:'POST',
                    dataType:'html',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'code':$('#code').val()
                    },
                    success:function (data) {
                        if(data==0){
                            $('#code_label').html('验证码不正确');
                            $('#code_label').css('color','snow');
                            $('#code_label').css('display','block');
                        }else{
                            $('#code_label').css('display','none');
                            $('#code_label').html('验证码正确');
                        }
                    }
                });
            }

        });
    });
</script>
<script type="text/javascript">
    //异步登录
    $(document).ready(function () {
        //ajax登陆
        $('#login').click(function () {
            if($('#number').val()!==''&& $('#password').val()!==''&&$('#code_label').html()!=='验证码不能为空'
                && $('#code_label').html()!=='验证码不正确'&&$('#code_label').html()=='验证码正确')
            {
                var number=$('#number').val();
                var password=$('#password').val();
                $.ajax({
                    url:"{{url('admin/login/check')}}",
                    type:'POST',
                    dataType:'html',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'number':number,
                        'password':password
                    },
                    success:function (data) {
                        if(data==0){
                            sweetAlert("用户名或密码不正确!", "", "error");
                        }else {
                            sweetAlert("登录成功！", "", "success");
                            setTimeout(window.location.href= "{{url('admin/home')}}", 2000);
                        }
                    }
                });
            }else {
                $('#login').attr('type','button');
                sweetAlert("请确认内容后提交!", "", "error");
            }
        });
    });
</script>
<script type="text/javascript" src="{{asset('public/js/rAF.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/demo-2.js')}}"></script>
</body>
</html>