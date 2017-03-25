<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>新人指引</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/home.css')}}">
    <link href="{{asset('public/css/smart_wizard.css')}}" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="{{asset('public/js/jquery-1.4.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/jquery.smartWizard-2.0.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            // Smart Wizard
            $('#wizard').smartWizard();

            function onFinishCallback(){
                $('#wizard').smartWizard('showMessage','Finish Clicked');
            }
        });
    </script>

</head>
<body>
<img>
<div id="header" >
    <nav class="navbar navbar-default " role="navigation" >
        <div class="container-fluid">
            <div class="navbar-header"style="height: 90px;">
                <a class="navbar-brand-1" style="font-family: 华文隶书;font-size: 6em;margin-top: 20px;text-decoration: none;" href="{{url('home')}}">Share-Car</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav  navbar-nav menu-1" style="margin-top: 36px;font-size: 1.5em;" >
                    <li id="li"><a href="{{url('search')}}">订单查询</a></li>
                    <li id="li"><a href="{{url('order')}}">在线下单</a></li>
                    <li id="li"><a href="{{url('location')}}">网点分布</a></li>
                    <li id="li"><a href="{{url('help')}}">新人指引</a></li>
                    <li id="li"><a href="{{url('about')}}">关于我们</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div id="wizard" class="swMain" style="margin-top: 6%;">
    <ul>
        <li><a href="#step-1"><span class="stepNumber">1</span><span class="stepDesc">用户注册<br /></span></a></li>
        <li><a href="#step-2"><span class="stepNumber">2</span><span class="stepDesc">资格审核<br /></span></a></li>
        <li><a href="#step-3"><span class="stepNumber">3</span><span class="stepDesc">在线预约<br /></span></a></li>
        <li><a href="#step-4"><span class="stepNumber">4</span><span class="stepDesc">定点取车<br /></span></a></li>
    </ul>
    <div id="step-1">
        <h2 class="StepTitle">注册详情</h2>
        <h4 style="color: #0f0f0f">
            <p>1.用户必须填写正确的邮箱地址,以便于查收正确的验证码</p>
            <p>2.注册时必须填写本人身份证号码，必须确保正确性，否则注册失败</p>
        </h4>
    </div>
    <div id="step-2">
        <h2 class="StepTitle">审查详情</h2>
        <h4 style="color: #0f0f0f">
            <p>1.用户需要上传本人的驾照的正反两面</p>
            <p>2.完善本人的真实信息，必须要保证姓名与驾照上面的姓名保持一致</p>
            <p>3.用户本人的身份证号必须与驾照上面的身份证号保持一致</p>
            <p>4.工作人员会在一个工作日之内进行审核</p>
        </h4>
    </div>
    <div id="step-3">
        <h2 class="StepTitle">预约须知</h2>
        <h4 style="color: #0f0f0f">
            <p>1.预约之前用户必须已经通过了审查，否则无法预约</p>
            <p>2.预约时，用户需在线下单</p>
            <p>3.若用户在1个小时之内无法取车，则系统默认用户放弃，在扣除相应违约金后，把余款打给用户的账户</p>
        </h4>
    </div>
    <div id="step-4">
        <h2 class="StepTitle">Step 4 Content</h2>
        <h4 style="color: #0f0f0f">
            <p>1.用户可以在对应车辆分布点取车</p>
            <p>2.取车点必须与订单上的取车点相一致，否则无法取车</p>
        </h4>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.buttonFinish').click(function () {
            setTimeout("javascript:location.href='http://115.159.43.143/car/home/login'", 11);
        });
    });
</script>

</body>
</html>