@extends('layouts.personal')
@section('title')
    <title>消费记录</title>
@endsection
@section('li')
    <ul class="nav nav-pills nav-stacked" role="tablist" style="font-family: 华文宋体;text-align: center;margin-left: -5px;" >
        <li  id="t1" role="presentation"><a href="{{url('home/personal')}}" ><h4 id="h1" >个人信息</h4></a></li>
        <li id="t2" role="presentation"><a href="{{url('home/personal/manage')}}"><h4 id="h2" >账户管理</h4></a></li>
        <li id="t3" role="presentation"><a href="{{url('home/user/rules')}}"><h4 id="h3">用户守则</h4></a></li>
        <li id="t4" role="presentation" class="active"><a href="{{url('home/payRecord')}}"><h4 id="h4">消费记录</h4></a></li>
        <li id="t5" role="presentation"><a href="{{url('home/user/comment')}}"><h4 id="h5">使用反馈</h4></a></li>
        <div style="height: 300px;"></div>
    </ul>
@endsection
@section('main')
    <div style="display: none;">{{date_default_timezone_set('Asia/Shanghai')}}</div>
    <table class="table">
        <thead>
            <th>订单编号</th>
            <th>车牌</th>
            <th>车型</th>
            <th>支付金额</th>
            <th>预约人</th>
            <th>预约时间</th>
        </thead>
        @foreach($record as $value)
            <tr>
                <td>{{$value->order_number}}</td>
                <td>{{$value->car_number}}</td>
                <td>{{$value->car_category}}</td>
                <td>{{$value->order_money}}</td>
                <td>{{$value->user_name}}</td>
                <td>{{date('Y:m:d H:i:s',$value->order_time)}}</td>
            </tr>
        @endforeach
    </table>

@endsection