@extends('layouts.common')
@section('title')
    <title>订单支付界面</title>
@endsection
@section('link')
    <link href="{{asset('public/PAY/css/ui-choose.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/css/sweet-alert.css')}}">
@endsection
@section('admin-login')
    @if(!empty(Session::get('username')))
        <div  style="text-align: right">
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
        <div class="row" >
            <div class="col-sm-offset-1 col-sm-10" style="height: 100px;border: #ddd 1px solid;">
                <div class="col-sm-6">
                    <h3 id="order_number" style="font-weight:900; ">订单号:&nbsp;&nbsp;
                        <small id="number" style="color: #0f0f0f ">
                            <?php echo time().Session::get('user_id');?>
                        </small>
                    </h3>
                </div>
                <div class="col-sm-4 col-sm-offset-2">
                    <h3 style="font-weight:900">下单人:&nbsp;&nbsp;<small style="color: #0f0f0f ">{{Session::get('username')}}</small></h3>
                </div>
            </div>
        </div>
        <div id="order"class="row" style="padding-top: 20px;">
            <div  class="col-sm-offset-1 col-sm-10"style="height: 320px;border: #ddd 1px solid;">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <a href="#" class="thumbnail">
                            <img src="{{asset($car_img)}}">
                        </a>
                    </div>
                    <div class="col-sm-9">
                        <h3><label>车型：{{$car_category}}</label>
                            <label style="padding-left: 120px;">车牌号：{{$car_number}}</label></h3><br>
                        <label>单价：{{$car_day_price}}元每天
                        {{$car_hour_price}}每小时</label>
                        <label style="padding-left: 120px;"><img src="{{asset('public/image/local.png')}}">
                            &nbsp;&nbsp;&nbsp;&nbsp;{{$area_name_road}}
                        </label>
                    </div>
                </div>
                <HR  style="border: #ddd 1px solid;" width="94%" color=#987cb9 SIZE=3>
                <div class="col-sm-10" >
                    <h4 style="color: black;padding-left:10px;">租用时间选择&nbsp;&nbsp;<img src="{{asset('public/image/time.png')}}"></h4>
                    <ul class="ui-choose"style="padding-left:10px;" id="uc_01">
                        <li id="hour">按小时租车</li>
                        <li id="day">按天租车</li>
                    </ul>
                </div>
                <div id="hour_sub" class="col-sm-10" style="padding-left:26px;padding-top: 20px;">
                    <select  class="ui-choose" id="uc_02" name="hour">
                        <option value="1">1小时</option>
                        <option value="2">2小时</option >
                        <option value="3">3小时</option>
                        <option value="4">4小时</option>
                        <option value="5">5小时</option>
                        <option value="6">6小时</option>
                        <option value="7">7小时</option>
                        <option value="8">8小时</option>
                    </select>
                </div>
                <div id="day_sub"class="col-sm-10" style="padding-left:26px;padding-top: 20px;">
                    <select class="ui-choose" id="uc_03" name="day">
                        <option value="1">1天</option>
                        <option value="2">2天</option>
                        <option value="3">3天</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-11 col-sm-offset-1 " style="padding-top: 20px;" >
                <div class="col-sm-12">
                    <h4 style="color: black;padding-left:10px;">付款方式：</h4>
                    <div class="col-sm-2">
                        <div id="weixin" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img  src="{{asset('public/PAY/image/weixinpay.png')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="wangyi" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/9999.v2.png')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="bank" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/bank.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            {{--各个银行--}}
            <div id="bank_list" class="col-sm-offset-1 col-sm-11" style="display: none;margin-top: 10px; padding-left: 15px;">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <div id="zhaoshang" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img  src="{{asset('public/PAY/image/0039.png')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="jiaotong" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/0059.png')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="chinabank" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/0060.png')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="jianshe" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/0061.png')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="xingye" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/0066.png')}}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"style="margin-top: 10px;">
                    <div class="col-sm-2" >
                        <div id="mingsheng" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/0069.png')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="gongshang" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/0071.png')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="zhongxin" style="border: #BCCCEE 1px solid;width: 146px;margin-right: 10px;height: 56px;position: relative;cursor: pointer;">
                            <img src="{{asset('public/PAY/image/0206.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-sm-offset-1" style="margin-top:10px;text-align: right;height:300px;padding-top: 240px;background: #F5F5F5;" id="money">
                <label id="pay" style="color: red;"></label>&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger">立即付款</button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('public/js/sweet-alert.js')}}"></script>

    <script src="{{asset('public/PAY/js/ui-choose.js')}}"></script>
    {{--计算价格--}}
    <script type="text/javascript">
        $(function () {
            $('#hour_sub').css('display','none');
            $('#day_sub').css('display','none');
            $('#money').css('display','none');
            $('#day').click(function () {
                $('#day_sub').css('display','');
                $('#hour_sub').css('display','none');
                $('#money').css('display','');
                $.ajax({
                    url:'{{asset('home/countPay')}}',
                    type:'POST',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'timeByDay':1,
                        'dayPrice':'{{$car_day_price}}'
                    },
                    success:function (data) {
                        $('#pay').html('应付金额'+'  '+data+'元');                    }
                });
            });
            $('#hour').click(function () {
                $('#hour_sub').css('display','');
                $('#day_sub').css('display','none');
                $('#money').css('display','');
                $.ajax({
                    url:'{{asset('home/countPay')}}',
                    type:'POST',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'timeByHour':1,
                        'hourPrice':'{{$car_hour_price}}'
                    },
                    success:function (data) {
                        $('#pay').html('应付金额'+'  '+data+'元');
                    }
                });

            });

        });

    </script>
    {{--租借时间的jq--}}
    <script type="text/javascript">
        // 将所有.ui-choose实例化
        $('.ui-choose').ui_choose();
        // uc_01 ul 单选
        var uc_01 = $('#uc_01').data('ui-choose'); // 取回已实例化的对象
        uc_01.click = function(index, item) {
            console.log('click', index, item.text())
        }
        uc_01.change = function(index, item) {
            console.log('change', index, item.text())
        }

        // uc_02 select 单选
        var uc_02 = $('#uc_02').data('ui-choose');
        uc_02.click = function(value, item) {
            console.log('click', value);
        };
        uc_02.change = function(value, item) {
            console.log('change', value);
            $.ajax({
                url:'{{asset('home/countPay')}}',
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    'timeByHour':value,
                    'hourPrice':'{{$car_hour_price}}'
                },
                success:function (data) {
                    $('#pay').html('应付金额'+'  '+data+'元');                }
            });

        };
        // uc_03 select 单选
        var uc_03 = $('#uc_03').data('ui-choose');
        uc_03.click = function(value, item) {
            console.log('click', value);
        };
        uc_03.change = function(value, item) {
            console.log('change', value);
            $.ajax({
                url:'{{asset('home/countPay')}}',
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    'timeByDay':value,
                    'dayPrice':'{{$car_day_price}}'
                },
                success:function (data) {
                    $('#pay').html('应付金额'+'  '+data+'元');
                }
            });
        };


    </script>
    {{--付款方式--}}
    <script type="text/javascript">
        $(function () {
            $('#weixin').click(function () {
                $('#weixin').css('border','blue 1px solid').attr('tag','1');
                $('#wangyi').css('border','#BCCCEE 1px solid').attr('tag','0');
                $('#bank').css('border','#BCCCEE 1px solid').attr('tag','0');
                $('#bank_list').css('display','none');
            });
            $('#wangyi').click(function () {
                $('#wangyi').css('border','blue 1px solid').attr('tag','1');
                $('#weixin').css('border','#BCCCEE 1px solid').attr('tag','0');
                $('#bank').css('border','#BCCCEE 1px solid').attr('tag','0');
                $('#bank_list').css('display','none');
            });
            $('#bank').click(function () {
                $('#bank').css('border','blue 1px solid').attr('tag','1');
                $('#wangyi').css('border','#BCCCEE 1px solid').attr('tag','0');
                $('#weixin').css('border','#BCCCEE 1px solid').attr('tag','0');
                $('#bank_list').css('display','');
            });
            $('#zhaoshang').click(function () {
                $('#bank').children().attr('src','{{asset('public/PAY/image/0039.png')}}')
                $('#wangyi').css('border','#BCCCEE 1px solid');
                $('#weixin').css('border','#BCCCEE 1px solid');
                $('#bank_list').css('display','none');
            });
            $('#jiaotong').click(function () {
                $('#bank').children().attr('src','{{asset('public/PAY/image/0059.png')}}')
                $('#wangyi').css('border','#BCCCEE 1px solid');
                $('#weixin').css('border','#BCCCEE 1px solid');
                $('#bank_list').css('display','none');
            });
            $('#chinabank').click(function () {
                $('#bank').children().attr('src','{{asset('public/PAY/image/0060.png')}}')
                $('#wangyi').css('border','#BCCCEE 1px solid');
                $('#weixin').css('border','#BCCCEE 1px solid');
                $('#bank_list').css('display','none');
            });
            $('#jianshe').click(function () {
                $('#bank').children().attr('src','{{asset('public/PAY/image/0061.png')}}')
                $('#wangyi').css('border','#BCCCEE 1px solid');
                $('#weixin').css('border','#BCCCEE 1px solid');
                $('#bank_list').css('display','none');
            });
            $('#xingye').click(function () {
                $('#bank').children().attr('src','{{asset('public/PAY/image/0066.png')}}')
                $('#wangyi').css('border','#BCCCEE 1px solid');
                $('#weixin').css('border','#BCCCEE 1px solid');
                $('#bank_list').css('display','none');
            });
            $('#mingsheng').click(function () {
                $('#bank').children().attr('src','{{asset('public/PAY/image/0069.png')}}')
                $('#wangyi').css('border','#BCCCEE 1px solid');
                $('#weixin').css('border','#BCCCEE 1px solid');
                $('#bank_list').css('display','none');
            });
            $('#gongshang').click(function () {
                $('#bank').children().attr('src','{{asset('public/PAY/image/0071.png')}}')
                $('#wangyi').css('border','#BCCCEE 1px solid');
                $('#weixin').css('border','#BCCCEE 1px solid');
                $('#bank_list').css('display','none');
            });
            $('#zhongxin').click(function () {
                $('#bank').children().attr('src','{{asset('public/PAY/image/0206.png')}}')
                $('#wangyi').css('border','#BCCCEE 1px solid');
                $('#weixin').css('border','#BCCCEE 1px solid');
                $('#bank_list').css('display','none');
            });
        });
    </script>
    <script type="text/javascript">
        //进行提交认证
        $(function(){
            $('button').click(function () {
                var choice1=$('#weixin').attr('tag');
                var choice2=$('#wangyi').attr('tag');
                var choice3=$('#bank').attr('tag');
                if(choice1=='1'|| choice2=='1'|| choice3=='1'){
                    var money=$('#pay').html();
                    var str=new RegExp(/[0-9]+/);
                    var pay=str.exec(money);
                    $.ajax({
                        url:'{{url('home/payOpt')}}',
                        type:'POST',
                        data:{
                            '_token':'{{csrf_token()}}',
                            'image':'{{$car_img}}',
                            'user_id':'{{Session::get('user_id')}}',
                            'car_number':'{{$car_number}}',
                            'order_number':$('#number').html().trim(),
                            'car_category':'{{$car_category}}',
                            'money':pay[0],
                            'location':'{{$area_name_road}}'
                        },
                        success:function (data) {
                            if(data=='1'){
                                sweetAlert("支付成功!", "", "success");
                                setTimeout(window.location.href= "{{url('home/personal')}}", 2000);
                            }else if(data=='2'){
                                sweetAlert("抱歉,您已经下过订单了!", "", "error");
                            }
                            else {
                                sweetAlert("抱歉,未知的错误!", "", "error");
                            }
                        }
                    });
                }else {
                    sweetAlert("注意", "请选择支付方式!", "error");
                }
            });
        });
    </script>
@endsection