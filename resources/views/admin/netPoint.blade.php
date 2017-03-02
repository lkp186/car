@extends('layouts.admin')
@section('title')
    <title>网点分布管理</title>
@endsection
@section('content')
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">网点管理</a></li>
            <li class="active">网点分布管理</li>
        </ol>
    </div>

    <div style="margin-left: 16%;">
        <form method="post" action="{{url('admin/home/netPoint/addNetPoint')}}" role="form">
            {{csrf_field()}}
            <label type="submit" class="label label-success"style="font-size: 1em;">网点区域</label>&nbsp;&nbsp;
            <select id="sel" name="area">
                <option>全部</option>
                <option>海州区</option>
                <option>连云区</option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label type="submit" class="label label-success"style="font-size: 1em;">网点名称</label>&nbsp;&nbsp;
            <input id="road" name="road" style="height: 23px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="sub" type="submit" class="btn btn-default btn-sm">提交</button>
        </form>
    </div>


    <div style="margin-left: 16%;">
        <input type="hidden" value="{{$i=1}}">
        <table class="table table-hover">
            <thead>
                <th>编号</th>
                <th>城市名</th>
                <th>所属区域</th>
                <th>街道名称</th>
                <th>操作</th>
            </thead>
            @foreach($area as $value)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->city_name}}</td>
                    <td>{{$value->area_name}}</td>
                    <td>{{$value->area_name_road}}</td>
                    <td>
                        <a role="button" href="{{url('admin/home/netPoint/delNetPoint?id='.$value->area_id)}}" class="btn btn-sm btn-danger">删除</a>
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $area->appends([])->links() !!}
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#sub').mouseover(function () {
                var road=$('#road').val();
                var opt=$('select option:selected').val();
                if(opt=='全部'){
                    $('#sub').attr('disabled','disabled');
                    alert('请先选择相应的网点区域');
                }else {
                    if(road==''){
                        $('#sub').attr('disabled','disabled');
                        alert('网点名称不能为空')
                    }else {
                        $('#sub').removeAttr('disabled','disabled')
                    }
                }
            });
            $('#road').blur(function () {
                var road=$('#road').val();
                if(road==''){
                    $('#sub').attr('disabled','disabled');
                    alert('网点名称不能为空')
                }else {
                    $('#sub').removeAttr('disabled','disabled');
                }
            });
        });
    </script>
@endsection