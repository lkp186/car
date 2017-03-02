<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>智慧城市-智慧交通</title>
    <link rel="stylesheet" href="{{asset('public/title/css/title.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-theme.min.css')}}">
</head>
<body>
    <div class="row">
        <img src="{{asset('public/title/title-car1.jpg')}}" style="position: fixed;">
    </div>
    <div style="position: absolute;margin-left: -80px;" >
        <canvas id="c"></canvas>
        <script src='{{asset('public/title/js/jquery.js')}}'></script>

        <script src="{{asset('public/title/js/index.js')}}"></script>
        <div style="text-align:center;clear:both;">
            <script src="/gg_bd_ad_720x90.js" type="text/javascript"></script>
        </div>
    </div>
</body>

<script language="javascript" type="text/javascript">
setTimeout("javascript:location.href='http://localhost/car/home'", 4000);
</script>
<script src="{{asset('public/title/js/prefixfree.min.js')}}"></script>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
</html>