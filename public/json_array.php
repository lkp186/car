<?php
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
$city=urlencode('上海');
$url="https://api.thinkpage.cn/v3/weather/daily.json?key=otkz6bh0xu4za9a3&location=$city&language=zh-Hans&unit=c&start=0&days=3";

$json=http_request($url);
$array=json_decode($json,true);

echo '<pre>';
print_r($array);
echo '</pre>';
echo $array['results'][0]['location']['name'];