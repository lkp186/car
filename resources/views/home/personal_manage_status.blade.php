@extends('layouts.personal')

@section('li')
    <ul class="nav nav-pills nav-stacked" role="tablist" style="font-family: 华文宋体;text-align: center;margin-left: -5px;" >
        <li  id="t1" role="presentation"><a href="{{url('home/personal')}}" ><h5 id="h1" style="color: snow">个人信息</h5></a></li>
        <li id="t2" role="presentation" class="active"><a href="{{url('home/personal/manage')}}"><h5 id="h2" style="color: snow">账户管理</h5></a></li>
        <li id="t3" role="presentation"><a href="{{url('home/user/rules')}}"><h5 id="h3"style="color: snow">用户守则</h5></a></li>
        <li id="t4" role="presentation"><a href="{{url('home/payRecord')}}"><h5 id="h4"style="color: snow">消费记录</h5></a></li>
        <li id="t5" role="presentation"><a href="{{url('home/user/comment')}}"><h5 id="h5"style="color: snow">使用反馈</h5></a></li>
        <div style="height: 300px;"></div>
    </ul>
@endsection

@section('main')
    <table class="table" style="color: snow;">
        <thead>
            <th>姓名</th>
            <th>驾驶证编号</th>
            <th>审核进度</th>
        </thead>
        <tr>
            <td>{{$result['user_name']}}</td>
            <td>{{$result['user_drive_id']}}</td>
            <td><label class="label label-info" style="font-size: 1em;">
                    @if($result['user_status']==0)
                       审核中
                    @elseif($result['user_status']==1)
                       已通过
                    @else
                        未通过
                    @endif
                </label>
            </td>
        </tr>

    </table>

@endsection