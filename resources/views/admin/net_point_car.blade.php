@extends('layouts.admin')
@section('title')
    <title>网点车辆管理</title>
@endsection
@section('link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
@endsection
@section('content')
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">网点管理</a></li>
            <li class="active">网点车辆管理</li>
        </ol>
    </div>

    {{--菜单二级联动--}}
    @if(Session::get('area'))
        <script type="text/javascript">
            $(function () {
                $("#area option[value='{{Session::get('area')}}']").attr("selected", true);
            });
        </script>
    @endif
    @if(Session::get('road'))
        <script type="text/javascript">
            $(function () {
                $("[name='road'] option[value='{{Session::get('road')}}']").attr("selected", true);
            });
        </script>
    @endif
    <div style="margin-left: 16%;">
        <form role="form" action="{{url('admin/home/netPoint/queryCar')}}" method="post">
            {{csrf_field()}}
            <label class="label label-warning" style="font-size: 1em;">区域:</label>&nbsp;&nbsp;
            <select id="area" name="area">
                <option value="海州区">海州区</option>
                <option value="连云区">连云区</option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="label label-warning" style="font-size: 1em;">详细名称:</label>&nbsp;&nbsp;
            <select id="haizhou" name="road" style="display: none;width: 300px;">
                 <option>全部</option>
                @foreach($area as $a)
                    @if($a->area_pid==1)
                        <option value="{{$a->area_name_road}}">{{$a->area_name_road}}</option>
                    @endif
                @endforeach
            </select>
            <select name="road" id="lianyun" style="display: none;width: 300px;">
                <option>全部</option>
                @foreach($area as $a)
                    @if($a->area_pid==2)
                        <option value="{{$a->area_name_road}}">{{$a->area_name_road}}</option>
                    @endif
                @endforeach
            </select>&nbsp;
            <button type="submit" class="btn btn-sm btn-primary">查询</button>&nbsp;&nbsp;
            <button type="button" id="add" class="btn btn-default btn-sm">添加</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <label  style="font-size: 1.5em;color: red">{{@$msg}}</label>
        </form>
    </div><br>
    <div style="margin-left: 16%;">
        <form id="formAdd" method="post" action="{{asset('admin/home/netPoint/addCar')}}" role="form" style="display: none;">
            {{csrf_field()}}
            <input name="area" id="hi" type="hidden">
            <input name="road" id="ha" type="hidden">
            <script type="text/javascript">
                $(function () {
                    var area=$('#area option:selected').text();
                    $('#hi').val(area);
                    $('#ha').val('全部');
                    $('#area').change(function () {
                        var area=$('#area option:selected').text();
                        $('#hi').val(area);
                    });
                    $('#haizhou').change(function () {
                        var road=$('#haizhou option:selected').text();
                        $('#ha').val(road);
                    });
                    $('#lianyun').change(function () {
                        var road=$('#lianyun option:selected').text();
                        $('#ha').val(road);
                    });
                });
            </script>
            <label class="label label-warning" style="font-size: 1em;">车辆添加</label>&nbsp;&nbsp;
            <label class="label label-info" style="font-size: 1em;">车型</label>&nbsp;&nbsp;
            <select name="category">
                <option value="大众cc">大众cc</option>
                <option value="本田思域">本田思域</option>
                <option value="长安逸动">长安逸动</option>
                <option value="捷达">捷达</option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="label label-info" style="font-size: 1em;">车牌</label>&nbsp;&nbsp;
            <input  type="text" name="number" style="width: 200px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="label label-info" style="font-size: 1em;">每小时价格</label>&nbsp;&nbsp;
            <input type="text" name="hour" style="width: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="label label-info" style="font-size: 1em;">每天价格</label>&nbsp;&nbsp;
            <input type="text" name="day" style="width: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" id="btn_sub" disabled="disabled"class="btn btn-success btn-sm">提交</button>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            var opt=$('#area').find("option:selected").text();
            if(opt=='海州区'){
                $('#haizhou').css('display','').attr('name','road');
                $('#lianyun').css('display','none').removeAttr('name');
            }else {
                $('#lianyun').css('display','').attr('name','road');
                $('#haizhou').css('display','none').removeAttr('name');
            }
            $('#area').change(function () {
                var opt=$('#area').find("option:selected").text();
                if(opt=='海州区'){
                    $('#haizhou').css('display','').attr('name','road');
                    $('#lianyun').css('display','none').removeAttr('name');
                }else {
                    $('#lianyun').css('display','').attr('name','road');
                    $('#haizhou').css('display','none').removeAttr('name');
                }
            });
        });
    </script>

    {{--表格--}}
    <div style="margin-left: 16%;">
        <input class="hidden" value="{{$i=1}}">
        <table class="table table-hover">
           <thead>
           <th>编号</th>
           <th>区域</th>
           <th>网点名称</th>
           <th>车型</th>
           <th>车牌</th>
           <th>车图</th>
           <th>车价</th>
           <th>操作</th>
           </thead>
            @if(!isset($area_sub))
                @foreach($area as $a)
                    @foreach($car as $c)
                        @if($c->car_pid==$a->area_id)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$a->area_name}}</td>
                                <td>{{$a->area_name_road}}</td>
                                <td>{{$c->car_category}}</td>
                                <td>{{$c->car_number}}</td>
                                <td>
                                    <img style="width: 60px;height: 30px;" src="{{asset($c->car_img)}}" data-action="zoom" />
                                </td>
                                <td>{{$c->car_hour_price}}元/小时-{{$c->car_day_price}}元/天</td>
                                <td><a href="{{url('admin/home/netPoint/deleteCar?id='.$c->car_id)}}" role="button" class="btn btn-danger btn-sm">删除</a></td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @else
                @foreach($area_sub as $a)
                    @foreach($car_sub as $c)
                        @if($c->car_pid==$a->area_id)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$a->area_name}}</td>
                                <td>{{$a->area_name_road}}</td>
                                <td>{{$c->car_category}}</td>
                                <td>{{$c->car_number}}</td>
                                <td>
                                    <img style="width: 60px;height: 30px;" src="{{asset($c->car_img)}}" data-action="zoom" />
                                </td>
                                <td>{{$c->car_hour_price}}元/小时-{{$c->car_day_price}}元/天</td>
                                <td><a href="{{url('admin/home/netPoint/deleteCar?id='.$c->car_id)}}" role="button" class="btn btn-danger btn-sm">删除</a></td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </table>
        @if(!isset($area_sub))
            {!! $car->appends([
            'area'=>Session::get('area'),
            'road'=>Session::get('road'),
            'number'=>Session::get('number'),
            'day'=>Session::get('day'),
            'hour'=>Session::get('hour'),
            'category'=>Session::get('category')])->links() !!}
        @else
            {!! $car_sub->appends([
            'area'=>Session::get('area'),
            'road'=>Session::get('road'),
            'number'=>Session::get('number'),
            'day'=>Session::get('day'),
            'hour'=>Session::get('hour'),
            'category'=>Session::get('category')])->links() !!}
        @endif
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('public/js/zooming.js')}}"></script>
    <script>
        $(function () {
            $('#btn_sub').mouseenter(function () {
                var number=$('input[name="number"]').val();
                var price_hour=$('input[name="hour"]').val();
                var price_day=$('input[name="day"]').val();
                var area=$('#area option:selected').text();
                if(number=='' || price_hour=='' || price_day==''){
                    $('#btn_sub').attr('disabled','disabled');
                }else {
                    $('#btn_sub').removeAttr('disabled');
                }
                if(area=='海州区'){
                    var road=$('#haizhou option:selected').text();
                    if(road=='全部'){
                        $('#btn_sub').attr('disabled','disabled');
                        alert('请选择网点名称')
                    }else {
                        $('#btn_sub').removeAttr('disabled');
                    }
                }
                if(area=='连云区'){
                    var road=$('#lianyun option:selected').text();
                    if(road=='全部'){
                        $('#btn_sub').attr('disabled','disabled');
                        alert('请选择网点名称')
                    }else {
                        $('#btn_sub').removeAttr('disabled');
                    }
                }
            });

            $('input[name="number"]').blur(function () {
                var number=$('input[name="number"]').val();
                var reg=/^[\u4e00-\u9fa5]{1}[A-Z]{1}[A-Z_0-9]{5}$/ig;
                if(number==''){
                    alert('车牌不能为空');
                    $('#btn_sub').attr('disabled','disabled');
                }else if(!reg.test(number)){
                    alert('车牌号不正确');
                    $('#btn_sub').attr('disabled','disabled');
                }
                else {
                    $('#btn_sub').removeAttr('disabled');
                }
            });

            $('input[name="hour"]').blur(function () {
                var price_hour=$('input[name="hour"]').val();
                var reg=/^[0-9]+$/ig;
                if(price_hour==''){
                    alert('价格不能为空');
                    $('#btn_sub').attr('disabled','disabled');
                }else{
                    if(!reg.test(price_hour)){
                        alert('价格只能是数字');
                        $('#btn_sub').attr('disabled','disabled');
                    }else {
                        $('#btn_sub').removeAttr('disabled');
                    }
                }

            });

            $('input[name="day"]').blur(function () {
                var price_day=$('input[name="day"]').val();
                var reg=/^[0-9]+$/ig;
                if(price_day==''){
                    alert('价格不能为空');
                    $('#btn_sub').attr('disabled','disabled');
                }else{
                    if(!reg.test(price_day)){
                        alert('价格只能是数字');
                        $('#btn_sub').attr('disabled','disabled');
                    }else {
                        $('#btn_sub').removeAttr('disabled');
                    }
                }

            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $('#add').click(function () {
                $('#formAdd').css('display','block');
            });
        });
    </script>
@endsection
