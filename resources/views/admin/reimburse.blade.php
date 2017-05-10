@extends('layouts.admin')
@section('title')
    <title>油费报销</title>
@endsection
@section('content')
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">报销管理</a></li>
            <li class="active">油费报销</li>
            @if($status==0)
                <li class="active"><label class="label label-info">审核中</label></li>
            @elseif($status==1)
                <li class="active"><label class="label label-success">审核通过</label></li>
            @else
                <li class="active"><label class="label label-danger">被拒绝</label></li>
            @endif
        </ol>
        用户状态切换:<a role="button"href="{{url('admin/gas/reimburse/refuse')}}" class="btn btn-sm btn-danger">已拒绝</a>
        <a role="button" href="{{url('admin/gas/reimburse/agreed')}}" class="btn btn-sm btn-success">审核通过</a>
        <a role="button" href="{{url('admin/gas/reimburse/view')}}" class="btn btn-sm btn-info">审核中</a>
    </div>
    <div style="margin-left: 16%;">

        <input type="hidden" value="{{$i=1}}">

        <table class="table table-hover">
            <thead>
            <th>编号</th>
            <th>报销人姓名</th>
            <th>报销人身份证号</th>
            <th>加油站地址</th>
            <th>加油工作人员工号</th>
            <th>油费发票</th>
            <th>加油前</th>
            <th>加油后</th>
            <th style="text-align: center">操作</th>
            </thead>
            @foreach($reimburse as $value)
                <div>
                    {{csrf_field()}}
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->user_name}}</td>
                        <td>{{$value->user_ID}}</td>
                        <td>{{$value->address}}</td>
                        <td>{{$value->work_number}}</td>
                        <td><img style="width: 60px;height: 30px;" src="{{asset($value->gas_invoice_url)}}" data-action="zoom" /></td>
                        <td><img style="width: 60px;height: 30px;" src="{{asset($value->gauge_before_url)}}" data-action="zoom" /></td>
                        <td><img style="width: 60px;height: 30px;" src="{{asset($value->gauge_after_url)}}" data-action="zoom" /></td>
                        <td style="text-align: center">
                            @if($status==1)
                            无
                            @elseif($status==0)
                            <a role="button" href="{{url('admin/gas/reimburse/agree_view?ID='.$value->user_ID)}}" class="btn btn-sm btn-warning">同意</a>
                            <a role="button" href="{{url('admin/gas/reimburse/refuseOpt?ID='.$value->user_ID)}}" class="btn btn-sm btn-danger">拒绝</a>
                            @else
                            <a role="button" href="{{url('admin/gas/reimburse/agree_view?ID='.$value->user_ID)}}" class="btn btn-sm btn-warning">同意</a>
                            @endif
                        </td>
                    </tr>
                </div>
            @endforeach
        </table>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('public/js/zooming.js')}}"></script>
@endsection