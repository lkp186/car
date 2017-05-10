<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
//主题界面的路由
Route::group(['middleware' => ['web'],'namespace'=>'Home'], function () {
    Route::get('home','HomeController@index');//网站主页
    Route::get('location','LocationController@index');//网点分布
    Route::get('order','OrderController@index');//在线下单，所有区域的全部车辆
    Route::get('search','SearchOrderController@index');//用户订单查询
    Route::get('help','HelpController@index');//新人指引
    Route::get('about','AboutController@index');//关于我们
});




//无需登录能通过的路由
Route::group(['middleware' => ['web'],'prefix'=>'home','namespace'=>'Home'], function () {
    //登录
    Route::get('login','LoginController@login');//登录界面
    Route::post('login/loginCheck','LoginController@loginCheck');//验证用户名和密码是否正确
    Route::get('login/code','LoginController@code');//添加验证码到登录界面
    Route::post('checkCode','LoginController@checkCode');//登录验证 check验证码是否正确

    //注册
    Route::get('register','RegisterController@registerPage');//跳转到注册界面
    Route::post('register/checkEmail','RegisterController@checkEmail');//注册邮箱验证路由
    Route::post('register/checkID','RegisterController@checkID');//注册邮箱验证路由
    Route::post('register/sendEmail','RegisterController@sendEmail');//注册邮箱验证路由
    Route::post('register/checkCode','RegisterController@checkCode');//验证注册码是否正确
    Route::post('register/register','RegisterController@register');//用户注册
    Route::get('login/logout','LoginController@logout');//用户退出


    //订单查询
    Route::post('search/searchOrder','SearchOrderController@search');



    //在线下单
    Route::get('order/areaAllCar','OrderController@areaAllCar');//显示某个辖区下的所有车辆
    Route::get('order/areaRoadAllCar','OrderController@areaRoadAllCar');//显示某个辖区下的这个街道的所有车辆

});


//用户登陆后才能访问的路由
Route::group(['middleware' => ['web','home'],'prefix'=>'home','namespace'=>'Home'], function () {

    Route::get('record','OrderRecordController@homeRecord');//从主页进入消费记录页面

    //用户预约
    Route::post('pay','PayController@index');//用户支付主界面
    Route::post('countPay','PayController@countPay');//ajax计算金额
    Route::post('payOpt','PayController@handle');//支付请求处理
    Route::get('payRecord','OrderRecordController@payRecord');//消费记录




    Route::get('notice','HomeController@notice');//订车须知
    //个人中心
    Route::get('personal','PersonalController@index');//个人中心页面
    Route::get('personal/manage','PersonalController@personalManage');//账户管理页面
    Route::post('upload','UploadController@index');//用户上传身份证和驾照
    Route::get('personal/margin','MarginController@index');//缴纳保证金界面
    Route::post('personal/margin/pay','MarginController@payMargin');//缴纳保证金的操作

    //用户守则
    Route::get('user/rules','PersonalController@rules');

    //使用反馈
    Route::get('user/comment','CommentController@commentView');//个人反馈界面
    Route::get('comment','CommentController@comment');//用户进行评论的界面
    Route::post('commentOpt','CommentController@commentOpt');//用户评论行为的处理

});

//后台管理员
Route::group(['middleware' => ['web'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    //登录界面相关的验证
    Route::get('login','AdminLoginController@index');//管理员登录界面
    Route::post('login/check','AdminLoginController@checkLogin');//异步登录验证
    Route::post('login/checkCode','AdminLoginController@checkCode');//验证登录验证码
});



//管理员登录之后才能访问
Route::group(['middleware' => ['web','admin'],'prefix'=>'admin','namespace'=>'Admin'], function () {


    Route::get('logout','AdminLoginController@logout');//管理员退出

    //管理员主界面
    Route::get('home','AdminHomeController@index');//管理员的主界面
    //用户管理
    Route::get('home/userCheck','AdminUserManageController@userCheck');//这是用户审核界面
    Route::get('home/changeStatus','AdminUserManageController@changeStatus');//更改用户状态
    Route::get('home/userDelete','AdminUserManageController@deleteUser');//删除用户界面
    Route::get('home/userDelete/delete','AdminUserManageController@delete_user');//删除用户操作界面

    //图片管理界面
    Route::get('home/imageManage','AdminImageManageController@index');//图片管理界面
    Route::post('home/imageManage/changeImage','AdminImageManageController@changeImage');//更改轮播图片

    //网点管理
    Route::get('home/netPointCar','NetPointManageController@index');//网点车辆分布
    Route::get('home/netPoint/deleteCar','NetPointManageController@deleteCar');//删除网点下的汽车
    Route::any('home/netPoint/queryCar','NetPointManageController@queryCar');//根据条件查找车辆
    Route::any('home/netPoint/addCar','NetPointManageController@addCar');//在相应的网点下添加车辆
    Route::any('home/netPoint','NetPointManageController@netPoint');//网点分布界面
    Route::any('home/netPoint/addNetPoint','NetPointManageController@addNetPoint');//添加网点
    Route::get('home/netPoint/delNetPoint','NetPointManageController@delNetPoint');//删除网点

    //账号管理界面
    Route::get('home/changePwd','AdminNumberManage@index');//管理员修改密码界面
    Route::post('home/checkOrgPwd','AdminNumberManage@checkOrgPwd');//验证原密码是否正确
    Route::post('home/changePwdOpt','AdminNumberManage@changePassword');//修改密码

    //用户评论管理界面
    Route::get('home/comment','AdminUserManageController@comment');//用户评论管理
    Route::get('home/comment/delete','AdminUserManageController@delComment');//用户评论删除操作

    //油费报销
    Route::get('gas/reimburse/view','ReimburseController@index');//油费报销界面

});

//微信公众号部分的路由
Route::group(['middleware'=>'web','prefix'=>'weiChat','namespace'=>'WeChat'],function (){
    Route::get('weather','WeatherController@index');//查询天气
    Route::get('location','LocationController@index');//用户位置
    Route::get('saveLocation','LocationController@saveLocation');//保存用户的地理位置
    Route::get('help','CommonController@help');//新人指引
    Route::get('searchOrder','CommonController@searchOrder');//订单查询
    Route::post('searchOrder/result','CommonController@searchResult');//展示查询结果
    Route::get('netStations','NetStationController@netStation');//网点分布
    Route::get('binding','CommonController@binding');//用户账号微信绑定界面
    Route::post('bindOpt','CommonController@bindOpt');//用户账号微信绑定操作
    Route::get('checkUsers','CommonController@checkBinding');//验证用户是否完成了绑定
    Route::get('reimburse/view','ReimburseController@index');//油费报销界面
    Route::post('reimburse/opt','ReimburseController@reimburseOpt');//油费报销操作
});



//主题界面的路由
Route::group(['middleware' => ['web'],'namespace'=>'Home'], function () {
    Route::get('get/car','GetCarController@index');//用户取车路由
    Route::post('get/getCar','GetCarController@getCar');//用户取车路由
    Route::post('get/returnCar','GetCarController@returnCar');//用户取车路由
});

