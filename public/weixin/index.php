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
        $content="";
        switch ($obj->Event){
            case 'subscribe':$content="欢迎关注Share-Car！"; $result=$this->transText($obj,$content);
                break;
            case 'unsubscribe':$content="Share-Car希望能与您再会！"; $result=$this->transText($obj,$content);
                break;
            case 'CLICK':
                switch ($obj->EventKey){
                    case 'music':
                        $content=array("Title"=>'FSN','Description'=>'超燃',
                            'MusicUrl'=>'http://b8107.cn/public/weixin/龙登杰 - Purple Passion紫色激情（重录版）.mp3',
                            'HQMusicUrl'=>'http://b8107.cn/public/weixin/龙登杰 - Purple Passion紫色激情（重录版）.mp3');
                        $result=$this->transMusic($obj,$content);
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
                    default:$content='菜单推送事件';$result=$this->transText($obj,$content);
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
        if(strstr($keyword,'文本')){
            $content="这是一个文本消息";
        }elseif (strstr($keyword,'单图文')){
            $content=array();
            $content[]=array('Title'=>'标题1',"Description"=>'描述1',
                "PicUrl"=>"http://img3.duitang.com/uploads/item/201602/21/20160221021642_2sVXm.thumb.700_0.jpeg",
                "Url"=>'http://www.weixinsucai.com/zhichangren/00032614');
        }elseif(strstr($keyword,'图文') || strstr($keyword,'多图文')){
            $content[]=array('Title'=>'标题1',"Description"=>'描述1',"PicUrl"=>"http://i0.hdslb.com/group1/M00/5F/F0/oYYBAFbVlPSACHJtAAIulgLE3S8670.jpg","Url"=>'http://www.weixinsucai.com/zhichangren/00030690');
            $content[]=array('Title'=>'标题2',"Description"=>'描述2',"PicUrl"=>"http://i0.hdslb.com/group1/M00/5F/F0/oYYBAFbVlPSACHJtAAIulgLE3S8670.jpg","Url"=>'http://www.weixinsucai.com/zhichangren/00030690');
            $content[]=array('Title'=>'标题3',"Description"=>'描述3',"PicUrl"=>"http://i0.hdslb.com/group1/M00/5F/F0/oYYBAFbVlPSACHJtAAIulgLE3S8670.jpg","Url"=>'http://www.weixinsucai.com/zhichangren/00030690');
            $content[]=array('Title'=>'标题4',"Description"=>'描述4',"PicUrl"=>"http://i0.hdslb.com/group1/M00/5F/F0/oYYBAFbVlPSACHJtAAIulgLE3S8670.jpg","Url"=>'http://www.weixinsucai.com/zhichangren/00030690');

        }elseif (strstr($keyword,'音乐')){
            $content=array("Title"=>'FSN','Description'=>'超燃',
                'MusicUrl'=>'http://b8107.cn/public/weixin/龙登杰 - Purple Passion紫色激情（重录版）.mp3',
                'HQMusicUrl'=>'http://b8107.cn/public/weixin/龙登杰 - Purple Passion紫色激情（重录版）.mp3');
            $result=$this->transMusic($obj,$content);
        }elseif (strstr($keyword,'天气')){
            $url="http://b8107.cn/weather?city=".mb_substr($keyword,2,10,"utf-8");
            $json=$this->http_request($url);
            $attr=json_decode($json,true);
            if(empty($attr)){
                $content="没有结果啊";
                $result=$this->transText($obj,$content);
            }else{
//                $weather=$attr['results'];
//                $weatherArray[] = array("Title" =>$weather[0]['location']['name']."天气预报", "Description" =>"", "PicUrl" =>"", "Url" =>"");
//                for ($i = 0; $i < count($weather["daily"]-1); $i++) {
//                    $weatherArray[] = array("Title"=>$weather['daily']['date']."\n",
//                        "Description"=>"",
//                        "PicUrl"=>"",
//                        "Url" =>"");
//                }
                $content=$attr['results'][0]['location']['name'];$result=$this->transText($obj,$content);
            }
        }
        else{
            $content="共享汽车-技术总监 刘康平 编写";
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

}

?>