@extends('layouts.admin')
@section('title')
    <title>用户删除</title>
@endsection
@section('content')
    <input type="hidden" value="{{$i=1}}">
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">用户管理</a></li>
            <li class="active">删除用户</li>
        </ol>
    </div>
    <div style="margin-left: 16%;">
        <table class="table table-striped">
            <thead>
            <th>编号</th>
            <th>用户姓名</th>
            <th>用户邮箱</th>
            <th>身份证号</th>
            <th>操作</th>
            </thead>
            @foreach($result as $value)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->user_name}}</td>
                    <td>{{$value->user_email}}</td>
                    <td>{{$value->user_ID_card}}</td>
                    <td><a href="{{url('admin/home/userDelete/delete?email='.$value->user_email)}}" role="button" class="btn btn-sm btn-danger">删除</a></td>
                </tr>
            @endforeach
        </table>
        {!! $result->appends(['email' =>Session::get('email')])->links() !!}
    </div>
@endsection