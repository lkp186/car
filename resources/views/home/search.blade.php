@extends('layouts.common')
@section('title')
    <title>订单查询</title>
@endsection
@section('link')
    <style type="text/css">
        body{
            background: #eee;
        }
    </style>
    {{--提示框--}}
    <link rel="stylesheet" href="{{asset('public/css/sweet-alert.css')}}">
@endsection
@section('content')
    <div class="row" style="margin-top: 13%;">
        <form role="form" method="post" action="{{url('home/search/searchOrder')}}">
            {{csrf_field()}}
            <div class="col-lg-4 col-lg-offset-4">
                <div class="input-group">
                    <input  type="text" class="form-control" name="ID" placeholder="身份证号" style="height: 50px;">
                    <span class="input-group-btn">
                <button id="btn" type="button" class="btn btn-info btn-block"style="height: 50px;width: 70px;">查找</button>
                </span>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{asset('public/js/sweet-alert.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('button').click(function () {
                var val=$('input').eq(1).val();
                var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
                if(val=='') {
                    $('#btn').attr('type','button');
                    sweetAlert("身份证号不能为空!", "", "error");
                }else if(!reg.test(val)){
                    sweetAlert("请输入正确的身份证号!", "", "error");
                    $('#btn').attr('type','button');
                }else {
                    $('#btn').attr('type','submit');
                }
            });
        });
    </script>
@endsection