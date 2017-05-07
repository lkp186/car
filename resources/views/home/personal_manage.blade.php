@extends('layouts.personal')
@section('title')
    <title>账户管理</title>
@endsection

@section('link')
@endsection


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
    <div class="" style="margin-top: 30px;">
        <div class="row">
            <div class="col-lg-offset-5 col-lg-6">
                <label class="label label-info" style="font-size: 2em;">资格审查</label>
            </div>
        </div>
        <div class="row" style=" margin-top: 20px;" >
            <form role="form" method="post" action="{{url('home/upload')}}"  enctype="multipart/form-data">
                <div class="col-lg-8 col-lg-offset-2">
                    <form role="form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1"class="label label-warning " style="font-size: 1em;">真实姓名</label>
                            <input type="text" name="true_name" class="form-control" id="true_name" placeholder="真实姓名" style="margin-top: 10px;">
                        </div>
                        <div class="form-group" style="height: 20px;">
                            <label id="label1" style="color: red;font-size: 1em;display: none;" id="label_sb" class="label label-info">姓名不能为空</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">请上传身份证正面照</label>
                            <input type="file" name="ID_card" id="File_ID">
                        </div><br/>
                        <div class="form-group">
                            <label for="exampleInputPassword1"  class="label label-warning " style="font-size: 1em;">驾驶证编号</label>
                            <input type="text" name="drive_number" class="form-control" id="drive_number" placeholder="驾驶证编号" style="margin-top: 10px;">
                        </div>
                        <div class="form-group" style="height: 20px;">
                            <label id="label2" style="color: red;font-size: 1em;display: none;" id="label_sb" class="label label-info">驾驶证编号不能为空</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">请上传驾驶证正面照</label>
                            <input type="file"  name="drive_card" id="File_drive">
                        </div>
                        <button id="btn" type="submit" class="btn btn-default">提交</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label style="color: red;display: none;font-size: 1em;" id="label_sb" class="label label-info">请按照要求上传图片!</label>
                    </form>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')


    <script type="text/javascript">
        $(document).ready(function () {
//            $('#t1').mouseover(function () {
//                $('#h1').css('color','black');
//                $('#t1').mouseout(function () {
//                    $('#h1').css('color','snow');
//                });
//            });
//            $('#t3').mouseover(function () {
//                $('#h3').css('color','black');
//                $('#t3').mouseout(function () {
//                    $('#h3').css('color','snow');
//                });
//            });
//            $('#t4').mouseover(function () {
//                $('#h4').css('color','black');
//                $('#t4').mouseout(function () {
//                    $('#h4').css('color','snow');
//                });
//            });
//            $('#t5').mouseover(function () {
//                $('#h5').css('color','black');
//                $('#t5').mouseout(function () {
//                    $('#h5').css('color','snow');
//                });
//            });
            $('#true_name').blur(function () {
                var file1=$('#true_name');
                if(file1.val()==''){
                    $('#label1').css('display','');
                }else {
                    $('#label1').css('display','none');
                }
            });
            $('#drive_number').blur(function () {
                var file2=$('#drive_number');
                if(file2.val()==''){
                    $('#label2').css('display','');
                }else {
                    $('#label2').css('display','none');
                }
            });
            $('#btn').mouseover(function () {
                var true_name=$('#true_name').val();
                var drive_number=$('#drive_number').val();
                var file_ID=$('#File_ID').val();
                var file_drive=$('#File_drive').val();
                if(file_ID!=='' && file_drive!=='' && drive_number!=='' && true_name!==''){
                    $('#btn').removeClass('disabled');
                    $('#btn').attr('type','submit');
                    $('#label_sb').css('display','none');
                } else {
                    $('#btn').addClass('disabled');
                    $('#btn').attr('type','button');
                    $('#label_sb').css('display','');
                }
            });
        });
    </script>


@endsection