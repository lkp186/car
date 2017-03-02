@extends('layouts.common')
@section('title')
    <title>在线下单</title>
    <script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
@endsection

@section('link')
    <link rel="stylesheet" href="{{asset('public/css/zeroModal.css')}}">
@endsection

@section('admin-login')
    @if(!empty(Session::get('username')))
        <div  style="margin-left: 85%">
            <a  role="button" style=" text-decoration: none;">
                <span class="label label-warning">您好！</span>
            </a>&nbsp;&nbsp;
            <a href="#" role="button" style=" text-decoration: none;">
                <span style="font-size: 0.7em;" class="label label-success">{{Session::get('username')}}</span>
            </a>&nbsp;&nbsp;
            <a href="{{url('home/login/logout')}}" role="button" style=" text-decoration: none;">
                <span style="font-size: 0.7em;" class="label label-danger">退出</span>
            </a>
        </div>
    @else
        <div  style="margin-left: 90%">
            <a href="{{asset('home/login')}}" role="button" style=" text-decoration: none;"><span class="label label-success">登录</span></a>&nbsp;
            <a href="{{asset('home/register')}}" role="button" style=" text-decoration: none;"><span class="label label-info">注册</span></a>
        </div>
    @endif

@endsection

@section('content')
    <div class="container">
        <div class="jumbotron" style="background-color:oldlace;margin-top: -20px;">
            <h3>城市辖区：&nbsp;&nbsp;<a href="{{url('order')}}" style="text-decoration: none;"><span id="all_area" class="{{@$class}}">全部</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @foreach($areaName as $value)
                    <a href="{{url('home/order/areaAllCar?city_id='.$value->city_id)}}"style="text-decoration: none;">
                        <span style="font-size: 18px;" id="span{{$value->city_id}}" >{{$value->city_area_name}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a>
                @endforeach
                <script type="text/javascript">
                    $(function () {
                        $('#span{{Session::get('city_id')}}').addClass('label label-primary');
                    });
                </script>
            </h3>
            <div id="road">
                <h3>网点分布：&nbsp;&nbsp;<a href="{{url('order')}}" style="text-decoration: none;"><span id="11" class="{{@$class}}">全部</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="hidden" value="{{$i=1}}">
                    @foreach($areaNameRoad as $value)
                        <a href="{{url('home/order/areaRoadAllCar?area_name_road='.$value->area_name_road)}}" style="text-decoration: none;">
                            <span style="font-size: 12px;" id="{{$value->area_name_road}}">{{$value->area_name_road}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </a>
                    @endforeach

                </h3>
            </div>
        </div>
        <div>
            @foreach($allCar as $value)
                <form role="form" method="post" action="{{url('home/pay')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="car_category" value="{{$value->car_category}}">
                    <input type="hidden" name="car_number" value="{{$value->car_number}}">
                    <input type="hidden" name="car_day_price" value="{{$value->car_day_price}}">
                    <input type="hidden" name="car_hour_price" value="{{$value->car_hour_price}}">
                    <input type="hidden" name="car_img" value="{{$value->car_img}}">
                    <input type="hidden" name="car_pid" value="{{$value->car_pid}}">
                    <input type="hidden" name="car_pid_pid" value="{{$value->car_pid_pid}}">
                    <div id='car_tree'class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <img src="{{asset($value->car_img)}}">
                            <div class="caption">
                                <h4><label class="label label-warning">{{$value->car_category}}</label>
                                    <label class="label label-success">{{$value->car_number}}</label></h4>
                                <p>
                                    <span class="label label-danger" >{{$value->car_day_price}}元/天</span>
                                    <span class="label label-danger" >{{$value->car_hour_price}}元/小时</span>
                                </p>
                                <div class="btn-group">
                                    <button id="bt" type="button" class="btn btn-sm btn-default">详情</button>
                                    <button  type="submit" class="btn btn-sm btn-primary">预约</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach

        </div>
        <div align="center">
            {!! $allCar->appends(['city_id' => Session::get('city_id'),'area_name_road'=>Session::get('area_name_road')])->links() !!}
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $('#{{Session::get('area_name_road')}}').addClass('label label-primary');
        });
    </script>
    <script type="text/javascript" src="{{asset('public/js/zeroModal.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#car_tree #bt').click(function () {
                var car_category=$(this).parent().parent().children().children().html();
                var hour_price=$(this).parent().parent().children().eq(1).children().eq(0).html();
                var day_price=$(this).parent().parent().children().eq(1).children().eq(1).html();
                var car_number=$(this).parent().parent().children().eq(0).children().eq(1).html();
                zeroModal.show({
                    title: '<h2 align="center">车辆详情</h2>',
                    content: '<table class="table table-bordered">' +
                    '<thead><th>车型</th><th>车牌</th><th>每小时价格</th><th>每天价格</th><th>状态</th></thead>'+
                    '<tr><td>'+car_category+'</td><td>'+car_number+'</td><td>'+day_price+'</td><td>'+hour_price+'</td>' +
                    '<td><label class="label label-success">可用</label></td></tr>'
                    +'</table>',
                    transition:true,
                    opacity: 1,
                });
            });
        });
    </script>
@endsection
