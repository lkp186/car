@extends('layouts.personal')
@section('title')
    <title>用户评价</title>
@endsection
@section('li')
    <ul class="nav nav-pills nav-stacked" role="tablist" style="font-family: 华文宋体;text-align: center;margin-left: -5px;" >
        <li  id="t1" role="presentation"><a href="{{url('home/personal')}}" ><h4 id="h1">个人信息</h4></a></li>
        <li id="t2" role="presentation" ><a href="{{url('home/personal/manage')}}"><h4 id="h2">账户管理</h4></a></li>
        <li id="t3" role="presentation"><a href="{{url('home/user/rules')}}"><h4 id="h3">用户守则</h4></a></li>
        <li id="t4" role="presentation"><a href="{{url('home/payRecord')}}"><h4 id="h4">消费记录</h4></a></li>
        <li id="t5" role="presentation" class="active"><a href="{{url('home/user/comment')}}"><h4 id="h5">使用反馈</h4></a></li>
        <div style="height: 300px;"></div>
    </ul>
@endsection
@section('main')
    <div style="padding-top: 20px;">
        <div style="display: none;">{{date_default_timezone_set('Asia/Shanghai')}}</div>
        @foreach($comment as $value)
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
                    </tr>
                </table>
            </div>
            <div style="background-color: white;"></div>
        @endforeach
        <form role="form" style="padding-top: 20px;" method="post" action="{{url('home/commentOpt')}}">
            <div class="row">
                <div class="col-md-12">
                    {{csrf_field()}}
                    <input type="hidden" name="order_number" value="{{$order_number}}">
                    <textarea name="content" class="form-control " rows="6"></textarea>
                </div>
                <div class="col-md-2 col-md-offset-10" style="padding-top: 10px;">
                    <button class="btn btn-warning btn-block" >评论</button>
                </div>
            </div>

        </form>
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