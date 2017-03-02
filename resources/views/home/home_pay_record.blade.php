@extends('layouts.common')
@section('title')
    <title>消费记录</title>
@endsection
@section('content')
    <div class="container" style="padding-top:10px;">
        <div class="panel panel-default panel-warning" >
            <div class="panel-heading ">
                <h3 class="panel-title">我的订单</h3>
            </div>
            <div class="panel-body">
                @if(count($order)==0)
                    <div style="margin:0 auto;;background-color: white; border: #5bc0de 1px dashed  ;height: 200px;">
                        <h1 style="text-align: center;padding-top: 40px;">很遗憾，您没有任何的订单。</h1>
                    </div>
                @else
                    @foreach($order as $value)
                        <div style="margin:0 auto;background-color: white; border: #5bc0de 1px dashed  ;">
                            <table class="table" style="font-size: 1.5em;">
                                <tr class="active" >
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
                                    <td style="vertical-align: middle;text-align: center"><button class="btn btn-default">评论</button></td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                @endif
                    {!! $order->links() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script  src="{{asset('public/js/jqthumb.min.js')}}"></script>
    <script >
        $(function(){
            $('.dowebok2').jqthumb({
                width: 160,
                height: 160,
                after: function(imgObj){
                    imgObj.css('opacity', 0).animate({opacity: 1}, 2000);
                }
            });
        });
    </script>
@endsection