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
        </ol>
    </div>
    <div style="margin-left: 16%;">

        <input type="hidden" value="{{$i=1}}">

        <table class="table table-hover">
            <thead>
            <th>编号</th>
            <th>报销人姓名</th>
            <th>报销人身份证号</th>
            <th>油费发票</th>
            <th>加油前</th>
            <th>加油后</th>
            </thead>
            @foreach($reimburse as $value)
                <form role="form" method="post" action="{{url('')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->user_name}}}</td>
                        <td>{{$value->user_ID}}}</td>
                        <td><img style="width: 60px;height: 30px;" src="{{asset($value->gas_invoice_url)}}" data-action="zoom" /></td>
                        <td><img style="width: 60px;height: 30px;" src="{{asset($value->gauge_before_url)}}" data-action="zoom" /></td>
                        <td><img style="width: 60px;height: 30px;" src="{{asset($value->gauge_after_url)}}" data-action="zoom" /></td>
                        <td><button type="submit" class="btn btn-sm btn-warning">更改</button></td>
                    </tr>
                </form>
            @endforeach
        </table>
    </div>
@endsection