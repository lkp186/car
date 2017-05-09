<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>账号绑定</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
</head>
<body>
<div class="jumbotron" style="text-align: center;"><h2 style="font-family: 微软雅黑">Share-Car账号绑定</h2></div>
<div class="container">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">小贴士:填写的信息均为您在ShareCar官网上注册的信息!!!</label>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="email" placeholder="email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">身份证号</label>
            <div class="col-sm-10">
                <input type="text" name="ID" class="form-control" id="ID" placeholder="ID">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary">绑定</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('button').click(function () {
            var email=$('#email').val();
            var ID=$('#ID').val();
            $.ajax({
                url:"{{url('weiChat/bindOpt')}}",
                type:'POST',
                dataType:'html',
                data:{
                    '_token':'{{csrf_token()}}',
                    'email':email,
                    'ID':ID,
                    'OpenID':'{{$OpenID}}'
                },
                success:function (data) {
                    if(data==0){
                        alert("用户名或密码不正确!");
                    }else {
                        alert("绑定成功!");
                    }
                }
            });
        });
    });
</script>
</body>
</html>
