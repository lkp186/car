<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/home.css')}}">
    @yield('link')
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-theme.min.css')}}">
</head>
<body>
<div id="header">
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

                <div  style="margin-left: 89%;margin-top: 5px;">
                    <a href="#" role="button" style=" text-decoration: none;"><span class="label label-success" style="font-size: 0.8em;">{{Session::get('username')}}已登录</span></a>
                    &nbsp;&nbsp;
                    <a href="{{url('home/login/logout')}}"style=" text-decoration: none;"><span class="label label-danger"style="font-size: 0.8em;">退出</span></a>
                </div>
            </div>
        </div>
    </nav>
</div>
<div style="margin-top: -20px;"><img src="{{url('public/image/personal/personal_bg.jpg')}}" style="position: absolute;width: 100%;height: 100%;"></div>
<div class="row" style="width: 250px;">
    @yield('li')
</div>
<div class="row" style="width: 60%;position: relative;margin-top: -584px;margin-left: 340px;">
    <div style="height: 584px;">
        @yield('main')
    </div>
</div>
{{--页脚--}}
</body>
{{--<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>--}}
<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
@yield('script')

</html>

















