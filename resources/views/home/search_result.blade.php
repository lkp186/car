@extends('layouts.common')
@section('title')
    <title>查询结果</title>
@endsection
@section('content')
        @if(count($record)!=0)
            <div>
                <div style="padding-top: 20px;">
                    <div style="display: none;">{{date_default_timezone_set('Asia/Shanghai')}}</div>
                    @foreach($record as $value)
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
                                    <td  style="vertical-align: middle;text-align: center"><img src="{{asset('public/image/id_card.png')}}">&nbsp;<label class="label label-danger">{{$value->order_name_ID}}</label></td>
                                    <td  style="vertical-align: middle;text-align: center"><label class="label label-success">{{$value->car_number}}</label></td>
                                    <td style="width: 300px;vertical-align: middle;text-align: center"><img src="{{asset('public/image/yuan.png')}}">&nbsp;{{$value->order_money}}</td>
                                    <td style="width: 400px;vertical-align: middle;text-align: left"><img src="{{asset('public/image/local.png')}}">&nbsp;&nbsp;{{$value->car_location}}</td>
                                </tr>
                            </table>
                        </div>
                    @endforeach

                </div>
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