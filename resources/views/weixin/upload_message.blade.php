<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
</head>
<body>
<div class="container">
    <div align="center" style="font-size: 1.2em;padding-top: 60px;font-family: 微软雅黑">
        @if($status==1)
            <img style="height: 60px;width: 60px;" src="{{asset('public/weixin/sign-check-icon.png')}}">{{$msg}}
        @else
            <img style="height: 60px;width: 60px;" src="{{asset('public/weixin/sign-error-icon.png')}}">{{$msg}}
        @endif
    </div>

</div>
</body>
</html>