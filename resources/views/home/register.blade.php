<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/admin_login_css/normalize.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/admin_login_css/demo.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/admin_login_css/component.css')}}" />
    <link rel="stylesheet" href="{{asset('public/css/home.css')}}">
    <script type="text/javascript" src="{{asset('public/js/html5.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/jquery.js')}}"></script>
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
                <label class="control-label">用户注册</label>
                <form class="form-horizontal" role="form" method="post" action="{{url('home/register/register')}}">
                    {{csrf_field()}}
                    <div class="form-group" style="width: 800px;">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="邮箱*">
                        </div>
                        <div class="col-sm-3" style="height: 34px;">
                            <label id="label_email" style="font-size: 20px;color: snow;display: none;"></label>
                        </div>
                    </div>

                    <div class="form-group" style="width: 800px;">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="text" name="username" class="form-control" id="inputName" placeholder="姓名*">
                        </div>
                        <div class="col-sm-3" style="height: 34px;">
                            <label id="label_username" style="font-size: 20px;color: snow;display: none;"></label>
                        </div>
                    </div>

                    <div class="form-group" style="width: 800px;">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="text" name="ID" class="form-control" id="inputID" placeholder="身份证号*">
                        </div>
                        <div class="col-sm-3" style="height: 34px;">
                            <label id="label_ID" style="font-size: 20px;color: snow;display: none;"></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="密码*">
                        </div>
                        <div class="col-sm-3" style="height: 34px;">
                            <label id="label_password" style="font-size: 20px;color: snow;display: none;"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="password" name="confirm_password" class="form-control" id="inputPasswordAgain" placeholder="确认密码*">
                        </div>
                        <div class="col-sm-3" style="height: 34px;">
                            <label id="label_confirm_password" style="font-size: 20px;color: snow;display: none;"></label>
                        </div>
                    </div>


                    <div class="form-group" >
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="text" name="code" class="form-control" id="inputCode" placeholder="验证码*">
                        </div>
                        <div class="col-sm-3 " style="margin-top: -24px;">
                            <button id="codeButton" type="button" class="btn btn-success ">发送验证码</button>&nbsp;
                        </div>
                        <div class="col-sm-3 " style="height: 34px;margin-top: -32px;"><label id="label_code" style="font-size: 20px;color: snow;display: none;"></label></div>
                    </div>

                    <div class="form-group">
                        <div class=" col-sm-3 col-sm-offset-3">
                            <button type="submit" id="register_button" class="btn btn-warning btn-block">注册</button>
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

<script type="text/javascript" src="{{asset('public/js/register.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#inputEmail').blur(function () {
            var inputEmail=$('#inputEmail').val();
            var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
            if(inputEmail==''){
                $('#label_email').html("邮箱不能为空");
                $('#label_email').css("display","block");
                $('#label_email').css("color","snow");
            } else{
                if(!reg.test(inputEmail)) {
                    $('#label_email').html("邮箱格式不正确");
                    $('#label_email').css("display", "block");
                    $('#label_email').css("color","snow");
                }else {
                    $.ajax({
                        url:"{{url('home/register/checkEmail')}}",
                        type:'POST',
                        dataType:'html',
                        data:{
                            '_token':'{{csrf_token()}}',
                            'email':inputEmail
                        },
                        success:function (data) {
                            if(data=='1'){
                                $('#label_email').html("此邮箱可以使用");
                                $('#label_email').css("display","block");
                                $('#label_email').css("color","green");
                            }else if(data=='0'){
                                $('#label_email').html("此邮箱已经被注册");
                                $('#label_email').css("display","block");
                                $('#label_email').css("color","snow");
                            }else {
                                $('#label_email').css("display","none");
                            }
                        }
                    })
                }
            }
        });

        $('#inputID').blur(function () {
            var inputID=$('#inputID').val();
            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
            if(inputID==''){
                $('#label_ID').html("身份证号不能为空");
                $('#label_ID').css("display","block");
                $('#label_ID').css("color","snow");
            }
            else {
                if(!reg.test(inputID)){
                    $('#label_ID').html("身份证号不正确");
                    $('#label_ID').css("display","block");
                    $('#label_ID').css("color","snow");
                }else {
                    $.ajax({
                        url:"{{url('home/register/checkID')}}",
                        type:'POST',
                        dataType:'html',
                        data:{
                            '_token':'{{csrf_token()}}',
                            'ID':inputID
                        },
                        success:function (data) {
                            if(data=='1'){
                                $('#label_ID').html("身份证号可以使用");
                                $('#label_ID').css("display","block");
                                $('#label_ID').css("color","green");
                            }else if(data=='0') {
                                $('#label_ID').html("身份证号已经被注册");
                                $('#label_ID').css("display","block");
                                $('#label_ID').css("color","snow");
                            }else {
                                $('#label_email').css("display","none");
                            }
                        }
                    })
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $('#codeButton').click(function (){
        if($('#label_email').html()=='此邮箱可以使用'){
            var inputEmail=$('#inputEmail').val();
            $.ajax({
                _token:"{{csrf_token()}}",
                url:"{{asset('home/register/sendEmail')}}",
                type:'POST',
                dataType:'html',
                data:{
                    '_token':'{{csrf_token()}}',
                    'email':inputEmail
                },
                success:function (data) {
                    alert(data);
                }
            });
        }else {
            alert('邮箱不正确，无法发送');
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#inputCode').mouseleave(function () {
            var inputCode=$('#inputCode').val();
            if(inputCode==''){
                $('#label_code').html("验证码不能为空");
                $('#label_code').css("display",'inline');
                $('#register_button').attr('disabled','false');
            }else {
                $.ajax({
                    url:"{{url('home/register/checkCode')}}",
                    type:'POST',
                    dataType:'html',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'code':inputCode
                    },
                    success:function (data)
                    {
                        if(data==0){
                            $('#label_code').html("验证码不正确");
                            $('#label_code').css("display",'inline');
                            $('#register_button').attr('disabled','true');

                        }else {
                            $('#register_button').attr('type','submit');
                            $('#register_button').removeAttr('disabled');
                            $('#label_code').css("display",'none');

                        }
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript" src="{{asset('public/js/rAF.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/demo-2.js')}}"></script>
</body>
</html>