<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @yield('title')
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/home.css')}}">
    <link href="{{asset('public/admin/css/VerticalMenu.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{asset('public/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/VerticalMenuJs.js')}}"></script>
</head>
<body>
<div id="header" >
    <nav class="navbar navbar-default " role="navigation" >
        <div class="container-fluid">
            <div class="navbar-header"style="height: 90px;">
                <a class="navbar-brand-1" style="font-family: 华文隶书;font-size: 6em;margin-top: 20px;text-decoration: none;" href="{{url('home')}}">Share-Car</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav  navbar-nav menu-1" style="margin-top: 36px;font-size: 1.5em;" >
                    <li id="li"><a>后台管理系统</a></li>
                </ul>
                <div style="margin-left: 80%">
                    <span class="label label-primary">欢迎你 {{Session::get('adminName')}}</span>
                    <a href="{{url('admin/logout')}}" style="text-decoration: none;"><span class="label label-danger">退出</span></a>
                </div>
            </div>
        </div>
    </nav>
</div>
<div style="margin-top: -20px;">
    <div class="VerticalMenu ">
        <div>
            <div><span>用户管理</span><i class="fa fa-angle-right fa-lg"></i></div>
            <div name="xz">
                <div>
                    <a href="{{asset('admin/home/userCheck?choice=0')}}"style="text-decoration: none;"><div><span>用户审核</span></div></a>
                </div>
                <div>
                    <a href="{{asset('admin/home/comment')}}" style="text-decoration: none;"><div><span>用户评论</span></div></a>
                </div>
                <div>
                    <a href="{{asset('admin/home/userDelete')}}" style="text-decoration: none;"><div><span>删除用户</span></div></a>
                </div>
            </div>
        </div>
        <div>
            <div><span >图片管理</span><i class="fa fa-angle-right fa-lg"></i></div>
            <div name="xz">
                <div>
                    <a href="{{asset('admin/home/imageManage')}}" style="text-decoration: none;"><div><span>轮播图片</span></div></a>
                </div>
            </div>
        </div>
        <div>
            <div><span>网点管理</span><i class="fa fa-angle-right fa-lg"></i></div>
            <div name="xz">
                <div>
                    <a href="{{url('admin/home/netPointCar')}}" style="text-decoration: none;"><div><span>网点车辆</span></div></a>
                </div>
                <div>
                    <a href="{{url('admin/home/netPoint')}}" style="text-decoration: none;"><div><span>网点分布</span></div></a>
                </div>
            </div>
        </div>
        <div>
            <div><span>账号管理</span><i class="fa fa-angle-right fa-lg"></i></div>
            <div name="xz">
                <div>
                    <a href="{{asset('admin/home/changePwd')}}" style="text-decoration: none;"><div><span>修改密码</span></div></a>
                </div>
            </div>
        </div>

    </div>
</div>
@yield('content')
{{--页脚--}}
@yield('foot')
</body>
<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
@yield('script')
</html>