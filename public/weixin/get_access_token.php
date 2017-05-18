<?php
/**
 * 获取access_token
 * User: Administrator
 * Date: 2017/2/13/013
 * Time: 9:05
 */
function http_request($url,$data=null){
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
function get_access_token(){
    $app_id="wxbbfbbbe89c83625b";
    $app_secret="fa684ef8617d8908ccff7ca778d51ebc";
    $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$app_id&secret=$app_secret";
    $json=http_request($url);
    $attr=json_decode($json,true);
    return $attr['access_token'];
}



//自定义菜单
$access_token=get_access_token();
$json_menu='
    {
     "button":[
     {
          "name":"先点我",
           "sub_button":[
           {
               "type":"click",
               "name":"新人指引",
               "key":"新人指引"
           },
           {
               "type":"click",
               "name":"当前位置",
               "key":"位置"
           },
           {
               "type":"click",
               "name":"语音帮助",
               "key":"music"
           }
           ]
     },
     {
          "name":"Share-Car",
           "sub_button":[
           {
               "type":"view",
               "name":"网点分布",
               "url":"http://b8107.cn/weiChat/netStations"
           },
           {
               "type":"view",
               "name":"订单查询",
               "url":"http://b8107.cn/weiChat/searchOrder"
           },
           {
               "type":"click",
               "name":"油费报销",
               "key":"油费报销"
           },
           {
               "type":"click",
               "name":"账号绑定",
               "key":"账号绑定"
           }
           
           ]
     },
     {
           "name":"便民服务",
           "sub_button":[
           {
               "type":"click",
               "name":"交通查询",
               "key":"traffic"
           },
           {
               "type":"view",
               "name":"快递查询",
               "url":"http://m.kuaidi100.com/"
           },
           {
               "type":"click",
               "name":"当前天气",
               "key":"weather"
           }
           ]
     }
     ]
 }



';
$menu_url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
$result=http_request($menu_url,$json_menu);
echo $result;






















