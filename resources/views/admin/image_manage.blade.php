@extends('layouts.admin')
@section('content')
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">图片管理</a></li>
            <li class="active">首页轮播图片</li>
        </ol>
    </div>
    <div style="margin-left: 16%;">

        <input type="hidden" value="{{$i=1}}">

            <table class="table table-hover">
                <thead>
                <th>编号</th>
                <th>轮播图片</th>
                <th>选择</th>
                <th>操作</th>
                </thead>
                @foreach($result as $value)
                    <form role="form" method="post" action="{{url('admin/home/imageManage/changeImage')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img style="width: 60px;height: 30px;" src="{{asset($value->image_path)}}" data-action="zoom" /></td>
                        <td>
                            <input type="hidden" name="path" value="{{$value->image_path}}">
                            <input name="image" type="file">
                        </td>
                        <td><button type="submit" class="btn btn-sm btn-warning">更改</button></td>
                    </tr>
                    </form>
                @endforeach
            </table>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('public/js/zooming.js')}}"></script>
@endsection