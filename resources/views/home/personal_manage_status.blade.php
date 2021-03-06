@extends('layouts.personal')

@section('li')
    <ul class="nav nav-pills nav-stacked" role="tablist" style="font-family: 华文宋体;text-align: center;margin-left: -5px;" >
        <li  id="t1" role="presentation"><a href="{{url('home/personal')}}" ><h4 id="h1">个人信息</h4></a></li>
        <li id="t2" role="presentation" class="active"><a href="{{url('home/personal/manage')}}"><h4 id="h2">账户管理</h4></a></li>
        <li id="t3" role="presentation"><a href="{{url('home/user/rules')}}"><h4 id="h3">用户守则</h4></a></li>
        <li id="t4" role="presentation"><a href="{{url('home/payRecord')}}"><h4 id="h4">消费记录</h4></a></li>
        <li id="t5" role="presentation"><a href="{{url('home/user/comment')}}"><h4 id="h5">使用反馈</h4></a></li>
        <div style="height: 300px;"></div>
    </ul>
@endsection

@section('main')
    <table class="table">
        <thead>
            <th>姓名</th>
            <th>驾驶证编号</th>
            <th>审核进度</th>
            <th>操作</th>
        </thead>
        <tr>
            <td>{{$result['user_name']}}</td>
            <td>{{$result['user_drive_id']}}</td>

                    @if($result['user_status']==0)
                <td>
                    <label class="label label-info" style="font-size: 1em;">审核中</label>
                </td>
                    @elseif($result['user_status']==1)
                <td>
                    <label class="label label-success" style="font-size: 1em;">已通过</label>
                </td>
                    @else
                <td>
                    <label class="label label-danger" style="font-size: 1em;">未通过</label>
                </td>
                <td>
                    <a class="btn btn-warning btn-sm" role="button" href="{{url('home/personal/reCheck')}}" >重新认证</a>
                </td>
                    @endif

        </tr>

    </table>

@endsection