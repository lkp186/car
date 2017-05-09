<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>油费报销</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/fileinput.min.css')}}">
    <script type="text/javascript" src="{{asset('public/weixin/js/fileinput.min.js')}}"></script>
</head>
<body>
<div class="jumbotron" style="text-align: center;"><h2 style="font-family: 微软雅黑">Share-Car邮费报销</h2></div>
<div class="container">
    <form class="form-horizontal" action="{{url('weiChat/bindOpt')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">小贴士:</label>
            <label for="inputEmail3" class="col-sm-6 control-label">报销需要加油发票照片以及车辆油表在加油前后的油表照片</label>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">加油发票图片</label>
            <div class="col-sm-10">
                <input type="file" name="gas_invoice" class="form-control" id="gas_invoice" placeholder="加油发票">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">加油前的油表照片</label>
            <div class="col-sm-10">
                <input type="file" name="gauge_before" class="form-control" id="gauge_before" placeholder="油表(前)">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">加油后的油表照片</label>
            <div class="col-sm-10">
                <input type="file" name="gauge_after" class="form-control" id="gauge_after" placeholder="油表(后)">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
</body>
</html>
