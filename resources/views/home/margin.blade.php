@extends('layouts.common')
@section('title')
    <title>保证金缴纳</title>
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
    <div class="container" style="padding-top: 90px;">

        <div class="row">
            <div class="col-sm-11 col-sm-offset-3" style="padding-top: 20px;" >
                <div class="col-sm-12" style="padding-left: 10px;">
                    <div class="col-sm-2">
                        <h4>保证金金额：</h4>
                    </div>
                    <div class="col-sm-2">
                        <h4 style="color: red;">3000元</h4>
                    </div>
                </div>
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
        </div>

        <div class="row">
            {{--各个银行--}}
            <div id="bank_list" class="col-sm-offset-3 col-sm-11" style="display:none ;margin-top: 10px; padding-left: 15px;">
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
        </div>
        <div class="row" style="padding-top: 20px;">
            <div class="col-sm-2 col-sm-offset-7">
                <button href="{{url('home/personal/margin/pay')}}" class="btn btn-primary btn-block" style="width: 125px; ">
                    立即付款
                </button>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('public/js/sweet-alert.js')}}"></script>

    <script src="{{asset('public/PAY/js/ui-choose.js')}}"></script>

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
    {{--ajax付款--}}
    <script type="text/javascript">
        $(function () {
            $('button').click(function () {
                $.ajax({
                    url:"{{url('home/personal/margin/pay')}}",
                    type:'POST',
                    dataType:'html',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'ID':'{{$ID}}'
                    },
                    success:function (data) {
                        if(data){
                            sweetAlert("支付成功！", "", "success");
                            setTimeout(window.location.href= "{{url('home/personal')}}", 5000);
                        }
                    }
                });
            });
        });
    </script>

@endsection