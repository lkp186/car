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
    <form class="form-horizontal" action="{{url('weiChat/bindOpt')}}" method="post">
        {{csrf_field()}}
        <input value="{{$OpenID}}" type="hidden">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-8 control-label">小贴士:填写的信息均为您在ShareCar官网上注册的信息!!!</label>
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
                <button type="submit" class="btn btn-primary">绑定</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
</body>
</html>
