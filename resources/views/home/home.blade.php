{{--网站主页--}}
@extends('layouts.common')
@section('title')
    <title>智慧城市-智慧交通</title>
@endsection
@section('link')
    <link rel="stylesheet" href="{{asset('public/css/responsiveslides.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/zeroModal.css')}}">
    <link href="{{asset('public/top/css/zzsc.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/css/sweet-alert.css')}}">
    <script type="text/javascript" src="{{asset('public/top/js/jquery-1.8.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/top/js/zzsc.js')}}"></script>
@endsection

{{--个人中心和管理员入口--}}
@section('admin-login')
    <div  style="text-align: right;">
        @if(Session::get('username'))
            <a href="{{url('home/personal')}}" role="button" style=" text-decoration: none;"><span class="label label-warning">个人中心</span></a>&nbsp;&nbsp;
            <a href="{{url('admin/login')}}" role="button" style=" text-decoration: none;"><span class="label label-danger">管理员入口</span></a>
        @else
            <a href="{{url('home/login')}}" role="button" style=" text-decoration: none;"><span class="label label-warning">个人中心</span></a>&nbsp;&nbsp;
            <a href="{{url('admin/login')}}" role="button" style=" text-decoration: none;"><span class="label label-danger">管理员入口</span></a>
        @endif
    </div>
@endsection

@section('content')
    <div >
        <div id="top"></div>
    </div>
    <div class="dowebok" >
        <ul class="rslides" id="dowebok" >
            @foreach($image as $value)
                <li><img class="home" src="{{asset($value->image_path)}}" alt=""></li>
            @endforeach
        </ul>
    </div>

    <div style="background-color:oldlace;margin-top: 20px;">
        <div class="container "style="background-color: snow;margin-top: -20px;">
            {{--首页图片轮播器--}}
            <div class="row" style="margin: -30px;">

                {{--价格与图片--}}
                <div class="col-sm-12 col-md-9">
                    <div class="page-header">
                        <h3><span class="glyphicon glyphicon-flash"></span>还在为出行担忧？<small>Share-car你的不二选择！</small></h3>
                    </div>
                        @foreach($result as $value)
                        <div class="car_tree">
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{asset($value->image_path)}}">
                                    <div class="caption">
                                        <h4><label class="label label-warning">{{$value->image_name}}</label></h4>
                                        <p>
                                            <span class="label label-danger">{{$value->car_day_price}}元/天</span>
                                            <span class="label label-danger" >{{$value->car_hour_price}}元/小时</span>
                                        </p>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-default">详情</button>

                                            <a href="{{url('order')}}"role="button" class="btn btn-sm btn-primary">预约</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
                <div class="col-sm-12 col-md-3"style="margin-top: 50px;">
                    <div class="panel panel-default">
                        <div class="panel-heading"align="center">
                            <img class="img-circle" src="{{asset('public/image/head2.jpeg')}}">
                            <br><br>
                            <div>
                                <p>@if(!empty(Session::get('username')))
                                        你好&nbsp;!&nbsp;&nbsp;&nbsp;{{Session::get('username')}}&nbsp;&nbsp;&nbsp;
                                        <a href="{{url('home/login/logout')}}" role="button" style=" text-decoration: none;"><span style="font-size: 0.7em;" class="label label-success">退出</span></a>
                                    @else
                                        hi,你好！
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="panel-body" align="center">
                            @if(!empty(Session::get('username')))
                                <a href="{{url('home/record')}}" role="button" style=" text-decoration: none;"><span style="font-size: 1em;" class="label label-danger">消费记录</span></a>&nbsp;
                                <a href="{{url('home/notice')}}" role="button" style=" text-decoration: none;"><span style="font-size: 1em;" class="label label-info">订车须知</span></a>&nbsp;
                                <a href="{{url('home/personal')}}" role="button" style=" text-decoration: none;"><span style="font-size: 1em;" class="label label-warning">个人中心</span></a>
                            @else
                                <a href="{{url('home/login')}}" role="button" style=" text-decoration: none;"><span style="font-size: 1em;" class="label label-success">登录</span></a>&nbsp;&nbsp;
                                <a href="{{url('home/register')}}" role="button" style=" text-decoration: none;"><span style="font-size: 1em;" class="label label-info">注册</span></a>&nbsp;&nbsp;
                            @endif
                        </div>
                    </div>
                </div>


                {{--服务宗旨--}}
                <div class="col-sm-12 col-md-9">
                    <div class="page-header">
                        <h3><span class="glyphicon glyphicon-user"></span>&nbsp;新体验!新生活！<small>&nbsp;&nbsp;全新的世界</small></h3>
                    </div>
                    <div class="col-xs-6 col-md-1">
                        <div class="thumbnail" style="margin-top: 50px;">
                            <img  src="{{asset('public/image/clock.png')}}" alt="...">
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-5">
                        <div class="jumbotron"style="text-indent: 1em;">
                            在周一至周六的7：00~18:00致电客服，随时为您解决问题！
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-1">
                        <div class="thumbnail" style="margin-top: 50px;">
                            <img  src="{{asset('public/image/heart.png')}}" alt="...">
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-5">
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <div class="thumbnail">
                                    <img src="{{asset('public/image/service/service1.png')}}" alt="...">
                                </div>
                                <div class="thumbnail">
                                    <img src="{{asset('public/image/service/service2.png')}}" alt="...">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="thumbnail">
                                    <img src="{{asset('public/image/service/service3.png')}}" alt="...">
                                </div>
                                <div class="thumbnail">
                                    <img src="{{asset('public/image/service/service4.png')}}" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="panel panel-danger" style="margin-top: -122px;">
                        <div class="panel-heading">不一样的体验，不一样的生活</div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" action="{{url('home/search/searchOrder')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="col-md-8">
                                        <input id="ID" name="ID" class="form-control" placeholder="身份证号">
                                    </div>
                                    <button type="button" id="hentai"   class="btn btn-sm btn-primary">查找订单</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div class="col-xs-6 col-md-1">
                        <div class="thumbnail" style="margin-top: 50px;">
                            <img src="{{asset('public/image/flag.png')}}" alt="...">
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-5">
                        <div class="jumbotron" style="text-indent: 1em;">
                            多种支付手段，多元化的服务，多种层次的选择！
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-1">
                        <div class="thumbnail" style="margin-top: 50px;">
                            <img src="{{asset('public/image/mail.png')}}" alt="...">
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-5">
                        <div class="jumbotron" style="text-indent: 1em;">
                            订单完成之后即可进行评价，我们会十分高兴地接纳您的建议！
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3" >
                    <div class="panel panel-warning" style="margin-top:-280px;">
                        <div class="panel-heading">用户评价</div>
                        <input type="hidden" value="{{date_default_timezone_set('Asia/Shanghai')}}">
                        <div class="panel-body comment"  >
                            <ul style="text-indent:0.5em;">
                                @foreach($comment as $value)
                                    <input type="hidden" value="{{$value->comment_name}}">
                                    <input type="hidden" value="{{date('Y-m-d H:i:s',$value->comment_time)}}">
                                    <input type="hidden" value="{{$value->comment_content}}">
                                    <li class="lkp"style="font-size: 18px;font-family: 微软雅黑">昵称：{{$value->comment_name}}于{{date('Y-m-d H:i:s',$value->comment_time)}}发表了评论</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div >
        <div  style="background-color: #c7ddef;margin-bottom: -10px;">
            <ul class="media-list"><br/>
                <li class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{asset('public/image/about-illustration-1.png')}}">
                    </a>
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{asset('public/image/arrow_next.png')}}">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">拯救你的钱包</h4>
                        <p>您用车，我供车。比起私家车，
                            省去维修、保养、保险、折旧等一系列大支出；比起出租车，我们的油费更少水分。
                            经济实惠，让您的钱包鼓一点</p>
                        <!-- 嵌套的媒体对象 -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{asset('public/image/arrow_next.png')}}">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">不再寂寞的等待</h4>
                                网点分布众多，充分考虑群众需求。急用车时刷卡即可开车，打车公交都是浮云！妈妈再也不用担心我赶不上晚饭啦！
                                <!-- 嵌套的媒体对象 -->
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="{{asset('public/image/arrow_next.png')}}"
                                             alt="通用的占位符图像">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">终结养车烦恼</h4>
                                        不用每天找车位，不用每个月抽时间洗车，不用每个季度打蜡。这些小问题我们统统帮您解决！
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 嵌套的媒体对象 -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{asset('public/image/about-illustration-3.png')}}"
                                     alt="通用的占位符图像">
                            </a><br/><br/>
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{asset('public/image/vote_yes.png')}}">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">口袋里的私家车</h4>
                                网上注册，送卡上门。手机APP、微信、电脑、客服电话多种渠道随时随地下单租车。尽最大的努力为您提供服务。车纷享，您口袋里的私家车。
                            </div>
                        </div>
                    </div>
                </li>
                <li class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{asset('public/image/about-illustration-2.png')}}"
                             alt="通用的占位符图像">
                    </a><br/><br/>
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{asset('public/image/action_check.png')}}"
                             alt="通用的占位符图像">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">多元化的选择</h4>
                        网点分布广，并且可供选择的车型较多，低档车到高档车，满足不同人群的需要。
                    </div>
                </li>
            </ul>
        </div>
    </div>

@endsection

@section('foot')
    <footer style="background-color:black;">
        <div class="container" >
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h5><p style="color: snow">支付方式：<img src="{{asset('public/image/wx.jpg')}}"><br></p></h5>
                </div>
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h5><p style="color: snow">维护人：&nbsp;刘康平<br></p></h5>
                </div>
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h5><p style="color: snow">建站时间：&nbsp;2017.1.5<br></p></h5>
                </div>
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h5><p style="color: snow">联系方式：&nbsp;1242580740@qq.com<br></p></h5>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('public/js/jquery.vticker.js')}}"></script>
    <script type="text/javascript">
        $('.comment').vTicker();
    </script>
    <script src="{{asset('public/js/responsiveslides.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            $('#dowebok').responsiveSlides();
        });
    </script>
    <script type="text/javascript" src="{{asset('public/js/zeroModal.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('.car_tree button').click(function () {
                var car_category=$(this).parent().parent().children().children().html();
                var hour_price=$(this).parent().parent().children().eq(1).children().eq(0).html();
                var day_price=$(this).parent().parent().children().eq(1).children().eq(1).html();
                zeroModal.show({
                    title: '<h2 align="center">车辆详情</h2>',
                    content: '<table class="table table-bordered">' +
                        '<thead><th>车型</th><th>每小时价格</th><th>每天价格</th></thead>'+
                        '<tr><td>'+car_category+'</td><td>'+day_price+'</td><td>'+hour_price+'</td></tr>'+
                    '</table>',
                    transition:true,
                    opacity: 1,
                });
            });
        });
    </script>
    <script src="{{asset('public/js/sweet-alert.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#hentai').click(function () {
                var val=$('#ID').val();
                var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
                if(val=='') {
                    $('#hentai').attr('type','button');
                    sweetAlert("身份证号不能为空!", "", "error");
                }else if(!reg.test(val)){
                    sweetAlert("请输入正确的身份证号!", "", "error");
                    $('#hentai').attr('type','button');
                }else {
                    $('#hentai').attr('type','submit');
                }
            });
        });
    </script>
    <script  src="{{asset('public/js/jqthumb.min.js')}}"></script>
    <script >
        $(function(){
            $('.home').jqthumb({
                width: $(window).width(),
                height: 490,
                after: function(imgObj){
                    imgObj.css('opacity', 0).animate({opacity: 1}, 2000);
                }
            });
        });
    </script>
    <script>
        $('.lkp').click(function () {
            var comment_name=$(this).prev().prev().prev().val();
            var comment_time=$(this).prev().prev().val();
            var comment_content=$(this).prev().val();
            zeroModal.show({
                title: '<h2 align="center"><label class="label label-warning">评论详情</label></h2>',
                content:'<div style="background-color: #f7ecb5;font-size: 20px;height: 120px;text-indent: 2em;">'+comment_content+'</div>'
                +'<div style="font-size: 1.3em;text-align: right;">'+'昵称：'+comment_name+'&nbsp;&nbsp;&nbsp;'+'日期：'+comment_time+'</div>',
                transition:true,
                opacity: 1,
            });
        });
    </script>
@endsection