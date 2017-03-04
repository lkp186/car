@extends('layouts.common')
@section('title')
    <title>网点分布</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=AoKIGVeahxDWHLgQYt9LnGGqG2xqCG5i">
        //v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
        //v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
    </script>
@endsection
@section('content')
    <div id="allmap" style="position:fixed;;width:1900px; height:880px;margin-top: -20px;"></div>
    <script type="text/javascript">
        map = new BMap.Map("allmap");

        map.setCurrentCity("连云港");

        map.addControl(new BMap.NavigationControl());
        map.addControl(new BMap.ScaleControl());
        map.addControl(new BMap.OverviewMapControl());
        map.addControl(new BMap.MapTypeControl());

        //全景
        var stCtrl = new BMap.PanoramaControl();
        stCtrl.setOffset(new BMap.Size(130, 0));
        map.addControl(stCtrl);


        map.centerAndZoom(new BMap.Point(119.227819,34.608707), 15);
        map.enableScrollWheelZoom(true);
        var data_info = [[119.227819,34.608707,"地址：海州区苍梧路59号淮海工学院"],
            [119.220878,34.622756,"地址：地址：海州区凌州东路7号(红星美凯龙斜对面)"],
            [119.223636,34.609691,"地址：海州区淮工邮政支局"],
            [119.222916,34.61866,"地址：江苏省连云港市海州区玉兰路秀逸苏杭"],
            [119.233713,34.605681,"地址：江苏省连云港市海州区学院路8号山海国际酒店"],
            [119.237292,34.651975,"地址：圣湖路连云港师范高等专科学校"],
            [119.246805,34.665663,"地址：连云港市海州区连云港职业技术学院-南门"],
            [119.203142,34.606115,"地址：海州区苍梧路27号（郁州北路与苍梧路交汇处）连云港国信云台大酒店"],
            [119.197556,34.599909,"地址：海州区瀛洲路26号连云港苏欣汽车客运站"],
            [119.189972,34.608391,"地址：苏宁易购(通灌北路店)通灌北路128号九龙世贸城大厦"],
            [119.19893,34.614492,"地址：大润发(连云港店)连云港市海州区陇海东路85号"],
            [119.375711,34.764607,"地址：连云区海棠北路在海一方公园"],
            [119.386203,34.756778,"地址：连云区连云港国际客运站"],
        ];
        var opts = {
            width : 250,     // 信息窗口宽度
            height: 80,     // 信息窗口高度
            title : '<h4 style="color: green">'+"取车点"+'</h4>' , // 信息窗口标题
            enableMessage:true//设置允许信息窗发送短息
        };
        for(var i=0;i<data_info.length;i++){
            var marker = new BMap.Marker(new BMap.Point(data_info[i][0],data_info[i][1]));
            // 创建标注
            var content = data_info[i][2];
            map.addOverlay(marker);               // 将标注添加到地图中
            addClickHandler(content,marker);
        }
        function addClickHandler(content,marker){
            marker.addEventListener("click",function(e){
                openInfo(content,e);
            });
        }
        function openInfo(content,e){
            var p = e.target;
            var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
            var infoWindow = new BMap.InfoWindow(content,opts);  // 创建信息窗口对象
            map.openInfoWindow(infoWindow,point); //开启信息窗口
        }
    </script>

@endsection





@section('script')

@endsection
