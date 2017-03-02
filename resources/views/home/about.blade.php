@extends('layouts.common')
@section('title')
    <title>关于我们</title>
@endsection
@section('link')
    <link rel="stylesheet" href="{{asset('public/css/about.css')}}">
@endsection

@section('content')
<!-- 文字区不需要请连css部分代码一并删除 -->
<h1 style="color: #0f0f0f;">
    我们想说
    <small style="color: #0f0f0f">
        Share-Car是一个刚刚起步的网站，也有着许许多多的不完善的地方。我们欢迎您给出任何的建议！
    </small>
    <small style="color: #0f0f0f">
        &nbsp;&nbsp;Share-Car是一个会员制的分时自助租赁平台,向会员提供以小时为计费单位的节能与新 能源汽车的自助租车服务。通过Share-Car自助租车系统，用户可以进行车辆预定、费用支付 、自助取车、还车及自动结算等，无需人工干预，非常简单，真正实现了家门口或公司门口 的自助租车，便捷、时尚、经济。
        Share-Car的愿景是致力于提高汽车使用效率、缓解城市交通 拥堵、减少尾气排放、改善城市环境，实现人、车与城市的和谐统一。

    </small>
    <small style="color: #0f0f0f">
        您在使用中有任何疑惑请致电18651052948
    </small>
</h1>

<!-- 你可以添加个多“.slideshow-image”项目, 记得修改CSS -->
<div class="slideshow" style="margin-top: -20px;">
    {{--<div class="slideshow-image" style="background-image: url('{{asset('public/image/about/1.jpg')}}')"></div>--}}
    <div class="slideshow-image" style="background-image: url('{{asset('public/image/about/2.jpg')}}')"></div>
    <div class="slideshow-image" style="background-image: url('{{asset('public/image/about/3.jpg')}}')"></div>
    <div class="slideshow-image" style="background-image: url('{{asset('public/image/about/4.jpg')}}')"></div>
</div>

@endsection
