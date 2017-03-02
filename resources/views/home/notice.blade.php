@extends('layouts.common')
@section('title')
    <title>订车须知</title>
@endsection
@section('content')
    <div class="container">
        <div style="font-family: 微软雅黑;">
            <div style="text-align: center;"><label class="label label-success"style="font-size: 1.5em;">订车须知</label></div>
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-5 col-md-offset-2">
                    <div>
                        <h3><img src="{{asset('public/image/tag.png')}}">一.如何使用车辆？</h3>
                        <div style="font-size: 1.2em; ">
                            <p >1.&nbsp;取车点还车（原取原还）</p>
                            <p style="text-indent:1em;">1.1&nbsp;只需三步还车：</p>
                            <p style="text-indent:1em;">车辆停稳后将档位挂N档或者P档，拉手刹；</p>
                            <p style="text-indent:1em;">关闭大灯等用电设备，关闭启动电源拔出钥匙；</p>
                            <p style="text-indent:1em;">点击显示屏上的“还车”，下车刷卡，检查车门是否关牢。</p>
                        </div>
                        <div style="font-size: 1.2em; ">
                            <p >2.&nbsp;使用小贴士</p>
                            <p style="text-indent:1em;">2.1&nbsp;方向盘无法转动、车辆无法旋转钥匙启动的处理：</p>
                            <p style="text-indent:1em;">一般是车辆方向盘锁牢了，这时只需转动钥匙的同时转动方向盘即可解除锁定。</p>
                            <p style="text-indent:1em;">2.2&nbsp;还车时将油量保持1/4以上，方便下一会员用车。</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div>
                        <h3><img src="{{asset('public/image/tag.png')}}">二.特殊情况，如何处理？</h3>
                        <div style="font-size: 1.2em; ">
                            <p >1.&nbsp;取车时找不到车怎么办？</p>
                            <p style="text-indent:1em;">请确认取车网点、停车位及车牌号是否一致，确认一致后还找不到车时请联系客服，会帮您解决。</p>
                        </div>
                        <div style="font-size: 1.2em; ">
                            <p >2.&nbsp;若因故未能按时还车的处理</p>
                            <p style="text-indent:1em;">只需通过网页或者微信服务菜单再次下单即可，若影响下一会员取车会有处罚哦</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-5 col-md-offset-2">
                    <div>
                        <h3><img src="{{asset('public/image/tag.png')}}">三.车辆使用过程中的操作</h3>
                        <div style="font-size: 1.2em; ">
                            <p >1.&nbsp;车油量，电量过低怎么办？</p>
                            <p style="text-indent:1em;">当车辆燃油量低时，只需在车内找到一张 中石化加油卡加油。</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div>
                        <h3><img src="{{asset('public/image/tag.png')}}">四.如有疑问，请电话客服</h3>
                        <div style="font-size: 1.2em; ">
                            <p >1.&nbsp;联系客服</p>
                            <p style="text-indent:1em;">任何的不满，请一定要告诉我们，我们一定会好好改善我们的不足。</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
@endsection