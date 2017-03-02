@extends('layouts.admin')
@section('title')
    <title>修改密码</title>
@endsection
@section('content')
    <div style="margin-left: 16%;">
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}" style="text-decoration: none;">Share-Car系统管理</a></li>
            <li><a href="#" style="text-decoration: none;">账号管理</a></li>
            <li class="active">修改密码</li>
        </ol>
    </div>
    <div style="margin-left: 32%;margin-top: 2%;">
        <form role="form" method="post" action="{{asset('admin/home/changePwdOpt')}}">
            {{csrf_field()}}
            <div style="height: 30px">
                <label id="la1" style="color: red;">{{@$msg}}
                </label>
                @if(isset($msg))
                    <script type="text/javascript">
                        setTimeout("javascript:location.href=\'http://localhost/car/admin/logout\'", 2000);
                    </script>
                @endif
            </div>
            <div style="height: 30px;">
                <label id="label" style="color:red;display: none;">原密码不正确!</label>
            </div>
            <div class="input-group" style="width: 400px;">
                <span class="input-group-addon" style="background-color:#ec971f;color: white;" id="basic-addon1">原 密 码&nbsp;</span>
                <input type="password" name="originalPassword" id="originalPassword" class="form-control"  aria-describedby="basic-addon1">
            </div><br>
            <div class="input-group" style="width: 400px;">
                <span class="input-group-addon "style="color: white;background-color: #5cb85c;" id="basic-addon1">新 密 码&nbsp;</span>
                <input type="password" name="newPassword"id="newPassword" class="form-control"  aria-describedby="basic-addon1">
            </div><br>
            <div class="input-group" style="width: 400px;">
                <span class="input-group-addon"style="background-color:#d9534f;color: white;"  id="basic-addon1">确认密码</span>
                <input type="password" name="confirmPassword"id="confirmPassword" class="form-control"  aria-describedby="basic-addon1">
            </div><br>
            <div class="input-group" style="width: 100px;">
                <button type="submit" class="btn btn-block btn-info ">提交</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
           $('#originalPassword').blur(function () {
               var originalPassword=$('#originalPassword').val();
               $.ajax({
                   url:'{{asset('admin/home/checkOrgPwd')}}',
                   type:'POST',
                   dataType:'html',
                   data:{
                       '_token':'{{csrf_token()}}',
                       'originalPassword':originalPassword,
                   },
                   success:function (data){
                       if(data==1){
                           $('#label').css('display','none');
                       }else{
                           $('#label').css('display','').html('原密码不正确!');
                       }
                   }
               });
           });
           $('#newPassword').blur(function () {
               var newPassword=$('#newPassword').val();
               if(newPassword==''){
                   $('#label').css('display','').html('新密码不能为空!');
               }
           });
           $('#confirmPassword').blur(function () {
               var confirmPassword=$('#confirmPassword').val();
               var newPassword=$('#newPassword').val();
               if(confirmPassword==''){
                   $('#label').css('display','').html('请再次确认密码!');
               }else if(confirmPassword!=newPassword){
                   $('#label').css('display','').html('两次密码不一致!');
               }else {
                   $('#label').css('display','').html('');
               }
           });
           $('button').mouseover(function () {
               var label=$('#label').html();
               if(label!='新密码不能为空!'&&label!='原密码不正确!'&&label!='请再次确认密码!'
               &&label!='两次密码不一致!'){
                   $('button').removeClass('disabled').attr('type','submit');
               }else {
                   $('button').addClass('disabled').attr('type','button');
               }
           });
        });
    </script>
@endsection