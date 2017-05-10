@extends('layouts.admin')
@section('title')
    <title>油费报销</title>
@endsection
@section('content')
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">报销管理</a></li>
            <li class="active">同意油费报销</li>
        </ol>
        <div style="padding-left: 20%">
            <label for="name">姓名</label>
            <input  id="name" disabled="true" class="form-control" style="width: 400px;" value="{{$user_name}}"><br>
            <label for="email">邮箱</label>
            <input  id="email"disabled="true"  class="form-control" style="width: 400px;" value="{{$user_email}}"><br>
            <label for="ID"  >身份号码</label>
            <input id="ID" name="ID" disabled="true"  class="form-control" style="width: 400px;" value="{{$ID}}"><br>
            <label for="money">报销金额</label>
            <input id="money" name="money" class="form-control" style="width: 400px;"><br>
            <button type="button" class="btn btn-primary">报销</button>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('public/js/zooming.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('button').click(function () {
                var money=$('#money').val();
                var reg = /[0-9*]/;
                if(money==''){
                    $('button').attr('type','button');
                    alert('金额不能为空');
                }else if(!reg.test(money)){
                    $('button').attr('type','button');
                    alert('金额只能是数字');
                }else {
                    $('button').click(function () {
                        var ID=$('#ID').val();
                        var money=$('#money').val();
                        var email=$('#email').val();
                        $.ajax({
                            url:'{{asset('admin/gas/reimburse/agree')}}',
                            type:'POST',
                            dataType:'html',
                            data:{
                                '_token':'{{csrf_token()}}',
                                'ID':ID,
                                'money':money,
                                'email':email
                            },
                            success:function (data){
                               if(data==1){
                                   alert('报销成功,已发送电子邮件通知客户');
                                   setTimeout(window.location.href= "{{url('admin/gas/reimburse/agreed')}}", 1000);
                               }else {
                                   alert('报销失败，未知的错误');
                               }
                            }
                        });
                    });
                }
            });
        });
    </script>
@endsection