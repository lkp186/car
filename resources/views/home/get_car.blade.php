@extends('layouts.common')
@section('title')
    <title>取车/还车</title>
@endsection
@section('link')
    <style type="text/css">
        body{
            background: #eee;
        }
    </style>
    {{--提示框--}}
    <link rel="stylesheet" href="{{asset('public/css/sweet-alert.css')}}">
    {{--小键盘--}}
    <link rel="stylesheet" type="text/css" href="{{asset('public/keyword/css/style.css')}}" />
@endsection
@section('content')
    <div class="container" style="padding-top: 16%">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <label>小贴士:只需要输入字母和数字部分</label><label> 如：苏Ajk77123456则输入Ajk77123456</label>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <textarea name="" id="write" style="width: 360px;font-size: 1.2em;"></textarea>
            </div>
        </div>
        <div class="row" style="padding-top: 20px;">
            <div class="col-sm-2 col-sm-offset-4">
                <button id="get" class="btn btn-warning btn-block" style="font-size: 2em;">取车</button>
            </div>
            <div class="col-sm-2 ">
                <button id="return" class="btn btn-primary btn-block" style="font-size: 2em;">还车</button>
            </div>
        </div>
        <div id='input_keybord'class="row" style="display: none;">
            <div class="col-sm-offset-3">
                {{--小键盘--}}
                <div >
                    <ul id="keyboard">
                        <li class="symbol"><span class="off">`</span><span class="on">~</span></li>
                        <li class="symbol"><span class="off">1</span><span class="on">!</span></li>
                        <li class="symbol"><span class="off">2</span><span class="on">@</span></li>
                        <li class="symbol"><span class="off">3</span><span class="on">#</span></li>
                        <li class="symbol"><span class="off">4</span><span class="on">$</span></li>
                        <li class="symbol"><span class="off">5</span><span class="on">%</span></li>
                        <li class="symbol"><span class="off">6</span><span class="on">^</span></li>
                        <li class="symbol"><span class="off">7</span><span class="on">&amp;</span></li>
                        <li class="symbol"><span class="off">8</span><span class="on">*</span></li>
                        <li class="symbol"><span class="off">9</span><span class="on">(</span></li>
                        <li class="symbol"><span class="off">0</span><span class="on">)</span></li>
                        <li class="symbol"><span class="off">-</span><span class="on">_</span></li>
                        <li class="symbol"><span class="off">=</span><span class="on">+</span></li>
                        <li class="delete lastitem">delete</li>
                        <li class="tab">tab</li>
                        <li class="letter">q</li>
                        <li class="letter">w</li>
                        <li class="letter">e</li>
                        <li class="letter">r</li>
                        <li class="letter">t</li>
                        <li class="letter">y</li>
                        <li class="letter">u</li>
                        <li class="letter">i</li>
                        <li class="letter">o</li>
                        <li class="letter">p</li>
                        <li class="symbol"><span class="off">[</span><span class="on">{</span></li>
                        <li class="symbol"><span class="off">]</span><span class="on">}</span></li>
                        <li class="symbol lastitem"><span class="off">\</span><span class="on">|</span></li>
                        <li class="capslock">caps lock</li>
                        <li class="letter">a</li>
                        <li class="letter">s</li>
                        <li class="letter">d</li>
                        <li class="letter">f</li>
                        <li class="letter">g</li>
                        <li class="letter">h</li>
                        <li class="letter">j</li>
                        <li class="letter">k</li>
                        <li class="letter">l</li>
                        <li class="symbol"><span class="off">;</span><span class="on">:</span></li>
                        <li class="symbol"><span class="off">'</span><span class="on">&quot;</span></li>
                        <li class="return lastitem">return</li>
                        <li class="left-shift">shift</li>
                        <li class="letter">z</li>
                        <li class="letter">x</li>
                        <li class="letter">c</li>
                        <li class="letter">v</li>
                        <li class="letter">b</li>
                        <li class="letter">n</li>
                        <li class="letter">m</li>
                        <li class="symbol"><span class="off">,</span><span class="on">&lt;</span></li>
                        <li class="symbol"><span class="off">.</span><span class="on">&gt;</span></li>
                        <li class="symbol"><span class="off">/</span><span class="on">?</span></li>
                        <li class="right-shift lastitem">shift</li>
                        {{--<li class="space lastitem">&nbsp;</li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script type="text/javascript" src="{{asset('public/keyword/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/keyword/js/keyboard.js')}}"></script>
    <script src="{{asset('public/js/sweet-alert.js')}}"></script>
    <script type="text/javascript">
        //控制小键盘的出现于消失
        $(function () {
            $('textarea').focus(function () {
                $('#input_keybord').css('display','block');
            });
            $('textarea').blur(function () {
                $('#input_keybord').css('display','block');
            });
            $('#get').mouseenter(function () {
                $('#input_keybord').css('display','none');
            });
            $('#return').mouseenter(function () {
                $('#input_keybord').css('display','none');
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            //取车的ajax请求
            $('#get').click(function () {
                var code=$('textarea').val();
                $.ajax({
                    url:"{{url('get/getCar')}}",
                    type:'POST',
                    dataType:'html',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'code':'苏'+code,
                    },
                    success:function (data) {
                        if(data==0){
                            sweetAlert("取车码不正确!", "", "error");
                        }else if(data==2){
                            sweetAlert("您已经成功取车", "", "success");
                        }
                        else {
                            sweetAlert("取车成功！请拿走钥匙", "", "success");
                        }
                    }
                });
            });
            $('#return').click(function () {
                //还车的ajax请求
                $('#return').click(function () {
                    var code=$('textarea').val();
                    $.ajax({
                        url:"{{url('get/returnCar')}}",
                        type:'POST',
                        dataType:'html',
                        data:{
                            '_token':'{{csrf_token()}}',
                            'code':'苏'+code,
                        },
                        success:function (data) {
                           if(data==1){
                               sweetAlert("还车成功！请放入车钥匙", "", "success");
                           }
                           else if(data==0){
                               sweetAlert("还车码不正确或者您已还车！", "", "error");
                           }
                        }
                    });
                });
            });
        });
    </script>
@endsection