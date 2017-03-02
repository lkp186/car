@extends('layouts.admin')
@section('title')
    <title>用户审核</title>
@endsection
@section('content')
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">用户管理</a></li>
            <li>用户审核</li>

                    @if($choice==0)
                <li class="active"><label class="label label-info">审核中</label></li>
                        @elseif($choice==1)
                <li class="active"><label class="label label-success">审核通过</label></li>
                        @else
                <li class="active"><label class="label label-danger">被拒绝</label></li>
                        @endif
        </ol>
    </div>
    <div style="margin-left: 16%;">
        {{csrf_field()}}
        用户状态切换:<a role="button"href="{{url('admin/home/userCheck?choice=2')}}" class="btn btn-sm btn-danger">已拒绝</a>
        <a role="button" href="{{url('admin/home/userCheck?choice=1')}}" class="btn btn-sm btn-success">审核通过</a>
        <a role="button" href="{{url('admin/home/userCheck?choice=0')}}" class="btn btn-sm btn-info">审核中</a>
        <table class="table table-striped">
            <thead>
                <th>用户姓名</th>
                <th>驾照编号</th>
                <th>身份证图片</th>
                <th>驾照图片</th>
                <th>用户状态</th>
                <th>操作</th>
                </thead>
                @foreach($result as $value)
                <tr>
                    <td>{{$value->user_name}}</td>
                    <td>{{$value->user_drive_id}}</td>
                    <td>
                        <img style="width: 60px;height: 30px;" src="{{asset('storage/app/public/'.$value->id_image)}}" data-action="zoom" />
                    </td>
                    <td>
                        <img style="width: 60px;height: 30px;" src="{{asset('storage/app/public/'.$value->drive_image)}}" data-action="zoom" />
                    </td>
                    @if($value->user_status==0)
                        <td><span class="label label-info">审核中</span></td>
                        <td>
                            <a role="button" href="{{url('admin/home/changeStatus?user_drive_id='.$value->user_drive_id).'&status=1&choice=0'}}" type="submit" class="btn btn-sm btn-warning">同意</a>
                            <a role="button" href="{{url('admin/home/changeStatus?user_drive_id='.$value->user_drive_id).'&status=2&choice=0'}}"type="submit" class="btn btn-sm btn-danger">拒绝</a>
                        </td>

                    @elseif($value->user_status==1)
                        <td><span class="label label-success">审核通过</span></td>
                        <td>
                            <a role="button" href="{{url('admin/home/changeStatus?user_drive_id='.$value->user_drive_id).'&status=2&choice=1'}}"type="submit" class="btn btn-sm btn-danger">拒绝</a>
                        </td>
                    @else
                        <td><span class="label label-danger">审核未通过</span></td>
                        <td>
                            <a role="button" href="{{url('admin/home/changeStatus?user_drive_id='.$value->user_drive_id).'&status=1&choice=2'}}" type="submit" class="btn btn-sm btn-warning">同意</a>
                        </td>
                    @endif

                </tr>
            @endforeach
        </table>
    </div>
    <div style="margin-left: 16%;margin-top: 16%;">
        {!! $result->appends(['choice' => Session::get('choice'),'user_drive_id' => Session::get('user_drive_id'),'status' => Session::get('status')])->links() !!}
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('public/js/zooming.js')}}"></script>
@endsection




