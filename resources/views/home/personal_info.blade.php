@extends('layouts.personal')
@section('title')
    <title>个人信息</title>
@endsection
@section('li')
    <ul class="nav nav-pills nav-stacked" role="tablist" style="font-family: 华文宋体;text-align: center;margin-left: -5px;" >
        <li  id="t1" role="presentation" class="active"><a href="{{url('home/personal')}}" ><h5 id="h1" style="color: snow">个人信息</h5></a></li>
        <li id="t2" role="presentation"><a href="{{url('home/personal/manage')}}"><h5 id="h2" style="color: snow">账户管理</h5></a></li>
        <li id="t3" role="presentation"><a href="{{url('home/user/rules')}}"><h5 id="h3"style="color: snow">用户守则</h5></a></li>
        <li id="t4" role="presentation"><a href="{{url('home/payRecord')}}"><h5 id="h4"style="color: snow">消费记录</h5></a></li>
        <li id="t5" role="presentation"><a href="{{url('home/user/comment')}}"><h5 id="h5"style="color: snow">使用反馈</h5></a></li>
    </ul>
@endsection
@section('main')
    <div style="display: none;">{{date_default_timezone_set('PRC')}}</div>
    <div style="margin-top: 26%;">
        <div class="container">
            <div class="page-header" style="width: 1200px;position: absolute;margin-left: -10%;margin-top: 0.6%">
                <a href="#" class="thumbnail" style="width: 17%"><img  src="{{asset('public/image/personal/head.jpg')}}"></a>
            </div>
            <div style="color: snow;margin-left: 150px;margin-top: 60px;"><h1 style="font-family: 华文楷体">欢迎来到Share-car！{{Session::get('username')}}</h1></div>
        </div>
        <div style="opacity: 0.8;width: 800px;height: 39px;margin-top:90px;margin-left: -90px;position: relative">
            <label class="label" style="color: #0f0f0f;font-size: 1.8em;position: absolute">可用余额：85元</label>
            <button class="btn btn-default"style="margin-left: 250px;width: 90px" >充值</button>
        </div>
        <div class="panel panel-default panel-info" style="margin-left: -80px;margin-top: 30px;">
            <div class="panel-heading ">
                <h3 class="panel-title">我的最新订单</h3>
            </div>
            <div class="panel-body" style="height: 300px;">
                @if(count($order)==0)
                    <div style="margin:0 auto;;background-color: white; border: #5bc0de 1px dashed  ;height: 200px;">
                        <h1 style="text-align: center;padding-top: 40px;">很遗憾，您没有任何的订单。</h1>
                    </div>
                @else
                    @foreach($order as $value)
                        <div style="margin:0 auto;;background-color: white; border: #5bc0de 1px dashed  ;">
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
                                    <td  style="vertical-align: middle;text-align: center"><label class="label label-primary">{{$value->car_number}}</label></td>
                                    <td style="width: 300px;vertical-align: middle;text-align: center"><img src="{{asset('public/image/yuan.png')}}">&nbsp;{{$value->order_money}}</td>
                                    <td style="width: 400px;vertical-align: middle;text-align: left"><img src="{{asset('public/image/local.png')}}">&nbsp;&nbsp;{{$value->car_location}}</td>
                                    <td style="vertical-align: middle;text-align: center"><button class="btn btn-primary">评论</button></td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#t2').mouseenter(function () {
                $('#h2').css('color','black');
                $('#t2').mouseleave(function () {
                    $('#h2').css('color','snow');
                });
            });

            $('#t3').mouseenter(function () {
                $('#h3').css('color','black');
                $('#t3').mouseleave(function () {
                    $('#h3').css('color','snow');
                });
            });
            $('#t4').mouseenter(function () {
                $('#h4').css('color','black');
                $('#t4').mouseleave(function () {
                    $('#h4').css('color','snow');
                });
            });
            $('#t5').mouseenter(function () {
                $('#h5').css('color','black');
                $('#t5').mouseleave(function () {
                    $('#h5').css('color','snow');
                });
            });
        });
    </script>
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