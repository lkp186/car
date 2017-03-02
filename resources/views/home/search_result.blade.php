@extends('layouts.common')
@section('title')
    <title>查询结果</title>
@endsection
@section('content')

        @if(count($record)!=0)
            <div class="container">
                <table class="table ">
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
            </div>
        @else
            <div class="container">
                <div class="jumbotron" >
                    <h1>没有找到该定订单</h1>
                    <p>请您确认您所输入的身份证号是否为订单上的身份证号</p>
                    <p><a class="btn btn-info btn-lg"style="width: 120px;" href="{{url('search')}}" role="button">继续查询</a></p>
                </div>
            </div>
        @endif

@endsection