<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
</head>
<body>
<div class="container">
    <div align="center">
        @if($msg='绑定成功')
            <img src="{{asset('public/weixin/sign-check-icon.png')}}">{{$msg}}
        @else
            <img src="{{asset('public/weixin/sign-error-icon.png')}}">{{$msg}}
        @endif
    </div>

</div>
</body>
</html>