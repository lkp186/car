@extends('layouts.personal')
@section('title')
    <title>用户反馈</title>
@endsection
@section('li')
    <ul class="nav nav-pills nav-stacked" role="tablist" style="font-family: 华文宋体;text-align: center;margin-left: -5px;" >
        <li  id="t1" role="presentation"><a href="{{url('home/personal')}}" ><h4 id="h1" >个人信息</h4></a></li>
        <li id="t2" role="presentation" ><a href="{{url('home/personal/manage')}}"><h4 id="h2">账户管理</h4></a></li>
        <li id="t3" role="presentation"><a href="{{url('home/user/rules')}}"><h4 id="h3">用户守则</h4></a></li>
        <li id="t4" role="presentation"><a href="{{url('home/payRecord')}}"><h4 id="h4">消费记录</h4></a></li>
        <li id="t5" role="presentation" class="active"><a href="{{url('home/user/comment')}}"><h4 id="h5">使用反馈</h4></a></li>
        <div style="height: 300px;"></div>
    </ul>
@endsection
@section('main')
    <div>
        <div style="display: none;">{{date_default_timezone_set('Asia/Shanghai')}}</div>
        @if(count($result)==0)
            <div style="margin:0 auto;;background-color: white; border: #5bc0de 1px dashed  ;height: 200px;">
                <h1 style="text-align: center;padding-top: 40px;">很遗憾，您没有任何的订单。</h1>
            </div>
        @else
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
                            <td style="vertical-align: middle;text-align: center">
                                <a  href="{{url('home/comment?order_number='.$value->order_number)}}" class="btn btn-primary" role="button">评论</a>
                            </td>
                        @else
                            <td style="vertical-align: middle;text-align: center"><button class="btn btn-success">已评价</button></td>
                        @endif
                    </tr>
                </table>
            </div>
            <div style="background-color: white;"></div>
        @endforeach
        @endif
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
