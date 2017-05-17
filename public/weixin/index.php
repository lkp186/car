<?php
define("TOKEN", "lkp_weixin");
$wechatObj = new wechatCallbackapiTest();
//操作选择
if(isset($_GET["echostr"])){
    $wechatObj->valid();//存在随机字符串则进行验证
}else{
    $wechatObj->responseMsg();
}
class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];//验证的随机字符串

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    //响应用户的消息
    public function responseMsg()
    {
        $postStr=$GLOBALS["HTTP_RAW_POST_DATA"];//接收的xml
        if(!empty($postStr)){
            $result="";//回复的xml;
            //接受到的消息写入日志
            $this->logger("R \r\n".$postStr);
            $postObj=simplexml_load_string($postStr,"SimpleXMLElement",LIBXML_NOCDATA);
            $type=trim($postObj->MsgType);
            switch ($type){
                case 'text':$result=$this->receiveText($postObj);
                    break;
                case 'image':$result=$this->receiveImage($postObj);
                    break;
                case 'location':$result=$this->receiveLocation($postObj);
                    break;
                case 'voice':$result=$this->receiveVoice($postObj);
                    break;
                case 'event':$result=$this->receiveEvent($postObj);
                    break;
                default:
                    $result="unknown".$type;break;
            }

            //回复给用户的消息写入日志
            $this->logger("T \r\n".$result);

            //回复消息给公众号
            echo $result;
        }else{
            echo "";
            exit;
        }
    }

    //接收事件的函数
    public function receiveEvent($obj){
        switch ($obj->Event){
            case 'subscribe':$content="欢迎关注Share-Car！"; $result=$this->transText($obj,$content);
                break;
            case 'unsubscribe':$content="Share-Car希望能与您再会！"; $result=$this->transText($obj,$content);
                break;
            case 'LOCATION':
                $url_org="http://api.map.baidu.com/geoconv/v1/?ak=yGzMC6nFDKrQ5rosSBaAywLPj94HBpmo&coords=$obj->Latitude,$obj->Longitude&from=3&output=json";
                $json_org= $json=file_get_contents($url_org);
                $attr_org=json_decode($json_org,true);
                $x=$attr_org['result'][0]['x'];
                $y=$attr_org['result'][0]['y'];
                $url="http://api.map.baidu.com/geocoder/v2/?location=$x,$y&output=json&coordtype=gcj0211&ak=yGzMC6nFDKrQ5rosSBaAywLPj94HBpmo";
                $json=file_get_contents($url);
                $attr=json_decode($json,true);
                $OpenID=$obj->FromUserName;
                $content=$attr['result']['addressComponent']['province'].'_';
                $content.=$attr['result']['addressComponent']['city'].'_';
                $content.=$attr['result']['addressComponent']['district'].'_';
                $content.=$attr['result']['addressComponent']['street'];
                //将每一次用户进入会话时的位置存入数据库
                $this->http_request("http://b8107.cn/weiChat/saveLocation?OpenID=$OpenID&content=$content");
                break;
            case 'CLICK':
                switch ($obj->EventKey){
                    case 'music':
                        $content=array("Title"=>'FSN','Description'=>'超燃',
                            'MusicUrl'=>'http://b8107.cn/public/weixin/music/龙登杰 - Purple Passion紫色激情（重录版）.mp3',
                            'HQMusicUrl'=>'http://b8107.cn/public/weixin/music/龙登杰 - Purple Passion紫色激情（重录版）.mp3');
                        $result=$this->transMusic($obj,$content);
                        break;
                    case '新人指引':
                        $content[] = array(
                            "Title" =>"新人指引",
                            "Description" =>"share-car带你走入不一样的世界",
                            "PicUrl" =>"http://b8107.cn/public/weixin/ss.jpg",
                            "Url" =>"http://b8107.cn/weiChat/help"
                        );
                        $result=$this->transNews($obj,$content);
                        break;
                    case 'traffic':
                        $content[] = array("Title" =>"交通信息","Description" =>"", "PicUrl" =>"", "Url" =>"http://m.8684.cn/bus");
                        $content[] = array("Title" =>"【公交线路】\n全车公交查询", "Description" =>"", "PicUrl" =>"http://photo.candou.com/ai/114/09caed4a27c56000bb870c68ab028850", "Url" =>"http://m.8684.cn/shenzhen_bus");
                        $content[] = array("Title" =>"【汽车班次】\n长途汽车班车", "Description" =>"", "PicUrl" =>"http://photo.candou.com/i/175/4951bd2a2f368cafc5ad09ff95ce591d", "Url" =>"http://touch.trip8080.com/");
                        $content[] = array("Title" =>"【火车时刻】\n火车时刻查询", "Description" =>"", "PicUrl" =>"http://photo.candou.com/ai/114/26a9407dcedda5f4a30b195f78ec3680", "Url" =>"http://m.ctrip.com/html5/Trains/");
                        $content[] = array("Title" =>"【飞 机 票】\n机票查询", "Description" =>"", "PicUrl" =>"http://photo.candou.com/i/175/a1bd6303a8bde7da50166aa8dafb7568", "Url" =>"http://touch.qunar.com/h5/flight/");
                        $content[] = array("Title" =>"【城市路况】\n重点城市实时路况", "Description" =>"", "PicUrl" =>"http://photo.candou.com/i/175/0d8488edf94574651d048025596a6190", "Url" =>"http://dp.sina.cn/dpool/tools/citytraffic/city.php");
                        $content[] = array("Title" =>"【违章查询】\n全国违章查询", "Description" =>"", "PicUrl" =>"http://g.hiphotos.bdimg.com/wisegame/pic/item/9e1f4134970a304eab30503cd0c8a786c8175ce2.jpg", "Url" =>"http://app.eclicks.cn/violation2/webapp/index?appid=10");
                        $result=$this->transNews($obj,$content);
                        break;
                    case 'weather':$content="请发送天气+城市名来查询天气例如：\n天气无锡";
                        $result=$this->transText($obj,$content);
                        break;
                    case '位置':
                        $OpenID=$obj->FromUserName;
                        $url="http://b8107.cn/weiChat/location?OpenID=$OpenID";
                        $json=$this->http_request($url);
                        $attr=json_decode($json,true);
                        if($attr['error']==0){
                            $content="您的大致位置如下\n".$attr['msg'];
                        }else{
                            $content="我们无权获取您的位置";
                        }
                        $result=$this->transText($obj,$content);
                        break;
                    case '油费报销':
                        $OpenID=$obj->FromUserName;
                        $url="http://b8107.cn/weiChat/checkUsers?OpenID=$OpenID";
                        $json=$this->http_request($url);//进行用户验证
                        $status=json_decode($json,true);
                        if($status['status']==0){
                            $content="请先进行账号绑定!";
                            $result=$this->transText($obj,$content);
                        }else{
                            $content[] = array(
                                "Title" =>"油费报销",
                                "Description" =>"请上传相应的图片",
                                "PicUrl" =>"http://b8107.cn/public/weixin/image/oil.jpg",
                                "Url" =>"http://b8107.cn/weiChat/reimburse/view?OpenID=$OpenID"
                            );
                            $result=$this->transNews($obj,$content);
                        }

                        break;
                    case '账号绑定':
                        $OpenID=$obj->FromUserName;
                        $url="http://b8107.cn/weiChat/checkUsers?OpenID=$OpenID";
                        $json=$this->http_request($url);//进行用户验证，看用户是否进行了账号绑定
                        $status=json_decode($json,true);
                        if($status['status']==0){
                            $content[] = array(
                                "Title" =>"账号绑定",
                                "Description" =>"将微信号与ShareCar账号绑定",
                                "PicUrl" =>"http://b8107.cn/public/weixin/bind.jpg",
                                "Url" =>"http://b8107.cn/weiChat/binding?OpenID=$OpenID"
                            );
                            $result=$this->transNews($obj,$content);
                        }else{
                            $content="您已经完成了账号绑定";
                            $result=$this->transText($obj,$content);
                        }
                        break;
                    default:
                        //假如用户没有开启获取地理位置的权限则会执行该操作，删除数据库中用户的地理位置
                        $content='抱歉，发生了位置的错误，无法匹配';$result=$this->transText($obj,$content);
                };
                break;
        }

        return $result;
    }



    //接收语音的函数
    public function receiveVoice($obj){
        if(isset($obj->Recognition)&&!empty($obj->Recognition)){
            $content="你刚才说的是：".$obj->Recognition;
            $result=$this->transText($obj,$content);
        }else{
            $content=array("MediaId"=>$obj->MediaId);
            $result=$this->transVoice($obj,$content);
        }
        return $result;
    }
    //回复语音消息
    public function transVoice($obj,$content){

        $item_tpl="<Voice>
        <MediaId><![CDATA[%s]]></MediaId>
        </Voice>";

        $item_str = sprintf($item_tpl,$content['MediaId']);

        $xml="
        <xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[voice]]></MsgType>
        $item_str
        </xml>
        ";
        $result = sprintf($xml, $obj->FromUserName, $obj->ToUserName, time(),$content['MediaId']);
        return $result;
    }



    //接收位置的函数
    public function receiveLocation($obj){
        $content = "你发送的是位置，纬度为：".$obj->Location_X."；经度为：".$obj->Location_Y."；缩放级别为：".$obj->Scale."；位置为：".$obj->Label;
        $result = $this->transText($obj, $content);
        return $result;
    }


    //接收图片消息的函数
    public function receiveImage($obj){
        $content = array("MediaId"=>$obj->MediaId);
        $result = $this->transmitImage($obj, $content);
        return $result;
    }
    //传输图片消息
    public function transmitImage($obj,$imageArray){
        $itemTpl = "<Image>
    <MediaId><![CDATA[%s]]></MediaId>
</Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $obj->FromUserName, $obj->ToUserName, time());
        return $result;
    }

    //接收文本消息的函数
    public function receiveText($obj){
        $keyword=trim($obj->Content);
       if (strstr($keyword,'天气')){
            if(!empty(mb_substr($keyword,2,10,"utf-8"))){
                $url="http://b8107.cn/weiChat/weather?city=".trim(mb_substr($keyword,2,10,"utf-8"));
                $json=$this->http_request($url);
                $array=json_decode($json,true);
                if(empty($array)){
                    $content="没有结果啊";
                    $result=$this->transText($obj,$content);
                }else{
                    $weatherArray[] = array(
                        "Title" =>$array['results'][0]["location"]['name']."天气预报",
                        "Description" =>"",
                        "PicUrl" =>"http://b8107.cn/public/weixin/image/tianqi.jpg",
                        "Url" =>"");
                    for ($i = 0; $i < count($array['results'][0]["daily"]); $i++) {
                        $img=$array['results'][0]['daily'][$i]['code_day'];
                        $weatherArray[] = array(
                            "Title"=>$array['results'][0]['daily'][$i]['date']."\t".$array['results'][0]['daily'][$i]['text_day']
                                ."\n最高温度：\t".$array['results'][0]['daily'][$i]['high']."℃ "
                                ."\t最低温度：\t".$array['results'][0]['daily'][$i]['low']."℃ "
                                ."风向：".$array['results'][0]['daily'][$i]['wind_direction']."\t"
                                ."\t风力：".$array['results'][0]['daily'][$i]['wind_scale'].'级',
                            "Description"=>"",
                            "PicUrl"=>"http://b8107.cn/public/weixin/weather/$img.png",
                            "Url" =>""
                        );
                    }
                    $content=$weatherArray;
                    $result=$this->transNews($obj,$content);
                }
            }else{
                $content="注意，查询天气的城市名称不能为空哦";
                $result=$this->transText($obj,$content);
            }
        } else {
           $content = $this->getXi($obj->FromUserName, $keyword);
           $result = $this->transText($obj, $content);
        }

        if(is_array($content)){
            if (isset($content[0]['PicUrl'])){
                $result=$this->transNews($obj,$content);
            }else if (isset($content['Music'])){
                $result = $this->transMusic($obj, $content);
            }

        }else{
            $result=$this->transText($obj,$content);
        }
        return $result;
    }


    //文本消息--回复音乐消息
    public function transMusic($obj, $music){
        $itemTpl = "<Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";

        $item_str = sprintf($itemTpl, $music['Title'], $music['Description'],
            $music['MusicUrl'], $music['HQMusicUrl']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $obj->FromUserName, $obj->ToUserName, time());
        return $result;
    }
    //文本消息--回复图文消息
    public function transNews($obj,$newsArray){
        if(!is_array($newsArray)){
            return '';
        }
        $itemTpl=" 
<item> 
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>";
        $item_str="";
        foreach ($newsArray as $item){
            $item_str.=sprintf($itemTpl,$item['Title'],$item['Description'],$item['PicUrl'],$item['Url']);
        }
        $itemTpl="
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
    $item_str
</Articles>
</xml>";
        return sprintf($itemTpl,$obj->FromUserName,$obj->ToUserName,time(),count($newsArray));
    }



    //向用户传文件消息的方法
    public function transText($obj,$content){
        $xml="
    <xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[%s]]></Content>
    </xml>
        ";
        return sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$content);
    }



    //日志记录
    public function logger($log_content)
    {

        $max_size = 100000;   //声明日志的最大尺寸

        $log_filename = "log.xml";  //日志名称

        //如果文件存在并且大于了规定的最大尺寸就删除了
        if(file_exists($log_filename) && (abs(filesize($log_filename)) > $max_size)){
            unlink($log_filename);
        }

        //写入日志，内容前加上时间， 后面加上换行， 以追加的方式写入
        file_put_contents($log_filename, date('H:i:s')." ".$log_content."\r\n", FILE_APPEND);

    }

    //token验证
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    //获取access_token
    public function get_access_token(){
        $app_id="wxbbfbbbe89c83625b";
        $app_secret="fa684ef8617d8908ccff7ca778d51ebc";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$app_id&secret=$app_secret";
        $json=http_request($url);
        $attr=json_decode($json,true);
        return $attr['access_token'];
    }

    //curl
    public function http_request($url,$data=null){
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        if(!empty($data)){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

        }
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $output=curl_exec($curl);
        curl_close($curl);
        return $output;

    }

    //机器人
    public function getXi($openid,$content){
        $app_key="GSlmLufQCebP";
        $app_secret="Awn4wz2kkyFSTd7KXyaR";
        //签名算法
        $realm = "xiaoi.com";
        $method = "POST";
        $uri = "/robot/ask.do";
        $nonce = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i < 40; $i++) {
            $nonce .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        $HA1 = sha1($app_key.":".$realm.":".$app_secret);
        $HA2 = sha1($method.":".$uri);
        $sign = sha1($HA1.":".$nonce.":".$HA2);

        //接口调用
        $url = "http://nlp.xiaoi.com/robot/ask.do";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth:    app_key="'.$app_key.'", nonce="'.$nonce.'", signature="'.$sign.'"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "question=".urlencode($content)."&userId=".$openid."&platform=custom&type=0");
        $output = curl_exec($ch);
        if ($output === FALSE){
            return "cURL Error: ". curl_error($ch);
        }
        return trim($output);
    }


}

?>