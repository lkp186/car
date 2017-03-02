@extends('layouts.personal')
@section('title')
    <title>用户反馈</title>
@endsection
@section('li')
    <ul class="nav nav-pills nav-stacked" role="tablist" style="font-family: 华文宋体;text-align: center;margin-left: -5px;" >
        <li  id="t1" role="presentation"><a href="{{url('home/personal')}}" ><h5 id="h1" style="color: snow">个人信息</h5></a></li>
        <li id="t2" role="presentation" ><a href="{{url('home/personal/manage')}}"><h5 id="h2" style="color: snow">账户管理</h5></a></li>
        <li id="t3" role="presentation"><a href="{{url('home/user/rules')}}"><h5 id="h3"style="color: snow">用户守则</h5></a></li>
        <li id="t4" role="presentation"><a href="{{url('home/payRecord')}}"><h5 id="h4"style="color: snow">消费记录</h5></a></li>
        <li id="t5" role="presentation" class="active"><a href="{{url('home/user/comment')}}"><h5 id="h5"style="color: snow">使用反馈</h5></a></li>
        <div style="height: 300px;"></div>
    </ul>
@endsection
@section('main')
    <div style="padding-top: 20px;">
        <div style="display: none;">{{date_default_timezone_set('Asia/Shanghai')}}</div>
        @foreach($result as $value)
            <div style="background-color: white;">
                <table class="table" style="font-size: 1.5em;">
                    <tr class="active">
                        <td colspan="5">{{date("Y-m-d H:i:s",$value->order_time)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            订单编号:&nbsp;&nbsp;{{$value->order_number}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            下单人:&nbsp;&nbsp;{{$value->user_name}}
                        </td>
                    </tr>
                    <tr >
                        <td>
                            <div class="row">
                                <div class="col-xs-6 col-md-3">
                                    <img class="dowebok2" src="{{asset($value->car_image)}}">
                                </div>
                            </div>
                        </td>
                        <td  style="vertical-align: middle;text-align: center"><label class="label label-success">{{$value->car_number}}</label></td>
                        <td style="width: 300px;vertical-align: middle;text-align: center"><img src="{{asset('public/image/yuan.png')}}">&nbsp;{{$value->order_money}}</td>
                        <td style="width: 400px;vertical-align: middle;text-align: left"><img src="{{asset('public/image/local.png')}}">&nbsp;&nbsp;{{$value->car_location}}</td>
                        @if($value->order_comment_status!=1)
                            <td style="vertical-align: middle;text-align: center"><button class="btn btn-primary">评论</button></td>
                        @else
                            <td style="vertical-align: middle;text-align: center"><button class="btn btn-success">已评价</button></td>
                        @endif
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script  src="{{asset('public/js/jqthumb.min.js')}}"></script>
    <script >
        $(function(){
            $('.dowebok2').jqthumb({
                width: 140,
                height: 140,
                after: function(imgObj){
                    imgObj.css('opacity', 0).animate({opacity: 1}, 2000);
                }
            });
        });
    </script>
@endsection
