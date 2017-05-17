<html>
<head>
    <title>网点分布</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=AoKIGVeahxDWHLgQYt9LnGGqG2xqCG5i">
        //v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
        //v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
    </script>
</head>
<body>
<div class="jumbotron" style="text-align: center;"><h2 style="font-family: 微软雅黑">Share-Car网点分布</h2></div>
<div class="row" style="margin-top: -30px;">
    <div class="col-xs-12">
        <div id="allmap" style="position:relative;width:100%; height:100%;"></div>
    </div>
</div>
<script type="text/javascript">
    var index = 0;
    var myGeo = new BMap.Geocoder();
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
    var adds =eval('{!!$newPoint!!}') ;
    var opts = {
        width : 250,     // 信息窗口宽度
        height: 80,     // 信息窗口高度
        title : '<h4 style="color: green">'+"取车点"+'</h4>' , // 信息窗口标题
        enableMessage:true//设置允许信息窗发送短息
    };

    function bdGEO(){
        var add = adds[index];
        geocodeSearch(add);
        index++;
    }
    function geocodeSearch(add){
        if(index < adds.length){
            setTimeout(window.bdGEO,400);
        }
        myGeo.getPoint(add, function(point){
            if (point) {
                var address = new BMap.Point(point.lng, point.lat);
                addMarker(address,'地址:'+add);
            }
        }, "连云港市");
    }
    // 编写自定义函数,创建标注
    function addMarker(point,content){
        var marker = new BMap.Marker(point);
        map.addOverlay(marker);
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        addClickHandler(content,marker);
    }
    //点击事件触发信息窗口
    function addClickHandler(content,marker){
        marker.addEventListener("click",function(e){
            openInfo(content,e);
        });
    }
    //打开信息窗口
    function openInfo(content,e){
        var p = e.target;
        var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
        var infoWindow = new BMap.InfoWindow(content,opts);  // 创建信息窗口对象
        map.openInfoWindow(infoWindow,point); //开启信息窗口
    }
    bdGEO();
</script>
</body>

</html>