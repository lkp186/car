@extends('layouts.admin')
@section('title')
    <title>用户评论</title>
@endsection
@section('content')
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">用户管理</a></li>
            <li class="active">用户评论</li>
        </ol>
    </div>
    <div style="margin-left: 16%;">
        <input type="hidden" value="{{$i=1}}">
        <table class="table table-hover">
            <thead>
                <th>编号</th>
                <th>评论内容</th>
                <th>评论人</th>
                <th>评论时间</th>
                <th>操作</th>
            </thead>
            @foreach($result as $value)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->comment_content}}</td>
                    <td>{{$value->comment_name}}</td>
                    <td>{{date("Y-m-d h:i:s", $value->comment_time)}}</td>
                    <td><a href="{{asset('admin/home/comment/delete?id='.$value->comment_id)}}" role="button" class="btn btn-sm btn-danger">删除</a></td>
                </tr>
            @endforeach
        </table>
        {!! $result->appends(['sort' => 'votes'])->links() !!}
    </div>


@endsection