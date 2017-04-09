@extends('layouts.personal')
@section('title')
    <title>用户守则</title>
@endsection
@section('li')
    <ul class="nav nav-pills nav-stacked" role="tablist" style="font-family: 华文宋体;text-align: center;margin-left: -5px;" >
        <li  id="t1" role="presentation"><a href="{{url('home/personal')}}" ><h4 id="h1" >个人信息</h4></a></li>
        <li id="t2" role="presentation"><a href="{{url('home/personal/manage')}}"><h4 id="h2" >账户管理</h4></a></li>
        <li id="t3" class="active" role="presentation"><a href="{{url('home/user/rules')}}"><h4 id="h3">用户守则</h4></a></li>
        <li id="t4" role="presentation"><a href="{{url('home/payRecord')}}"><h4 id="h4">消费记录</h4></a></li>
        <li id="t5" role="presentation"><a href="{{url('home/user/comment')}}"><h4 id="h5">使用反馈</h4></a></li>
    </ul>
@endsection
@section('main')
    <h1 style="padding-top: 35%;text-align: center;">Share—Car用户守则</h1>
    <div style="text-indent:2em;color:snow;font-family:楷体;background-color: snow;opacity: 0.9;">
        <div style="height: 12px;"></div>
        <h3 style="color: black;">一.使用限制</h3>
        <div style="font-size: 1.2em;color: black">
            <p>1. 会员不得以任何方式将汽车提供给任何非授权驾驶人驾驶。</p>
            <p>2. 会员不得将汽车出租用于运送人员或财物。</p>
            <p>3. 会员不得将汽车用于任何非法用途；或以任何非法或粗鲁方式使用；或用于比赛或速度竞赛；或运送易燃易爆物品、化学品、易腐物品或其它有害原材料或任何种类和性质的污染物质。</p>
            <p>4. 任何服用酒精、麻醉品或药物的人员不得驾驶，无论其是否在医生的指导下使用上述物品。</p>
            <p>5. 会员不得将汽车行驶到任何没有铺设路面的土路上行驶或越野行驶，“车纷享”以书面形式批准的除外。</p>
            <p>6. 汽车不得承载超出核定限乘人数以外的乘客。</p>
            <p>7. 会员不得拆除车内配备的任何物品。</p>
            <p>8. 会员不得恶意遮挡或损害车内行车记录仪。</p>
            <p>9. 会员违反使用限制，将承担因此而造成的全部法律责任和经济赔偿责任，并无权通过保险和千元免赔获得任何可能的补偿。“车纷享”可在不向会员发出通知的情况下，终止其使用汽车的权利和会员资格。“车纷享”保留法律规定的权利，包括但不限于不经过法律程序向会员发出通知而扣押汽车，会员有义务支付所有“车纷享” 将汽车追回所发生的费用。</p>
            <p>10. 如果会员在使用权利终止后继续使用汽车，“车纷享”有权通知公安机关车辆被盗。</p>
        </div>
        <h3 style="color: black">二.事故和报告</h3>
        <div style="font-size: 1.2em;color: black">
            <p>
                1. 会员同意在任何时间均小心谨慎地使用汽车。任何事故，无论所处环境或严重程度如何，会员必须立即报告“车纷享”。对于在汽车共享使用期间发生的任何保险理赔的调查和解决，会员有责任全力配合保险公司的工作。 未能立即报告事故和配合事故调查、解决工作，会员应承担全部损失责任和费用。
            </p>
        </div>
        <h3 style="color: black">三.交通违法</h3>
        <div style="font-size: 1.2em;color: black">
            <p>
                1. 会员同意在任何时间均小心谨慎地使用汽车。任何事故，无论所处环境或严重程度如何，会员必须立即报告“车纷享”。对于在汽车共享使用期间发生的任何保险理赔的调查和解决，会员有责任全力配合保险公司的工作。 未能立即报告事故和配合事故调查、解决工作，会员应承担全部损失责任和费用。
            </p>
        </div>
    </div>
@endsection