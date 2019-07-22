<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
$app->post('app_tv_package_switch','TVController@AppTvPackageSwitch');  //电视切换系统的回调接口
$app->post('app_tv_newVersion','TVController@TvNewVersion');  //电视切换系统的回调接口
$app->post('app_tv_polling','TVController@AppTVPolling');  //电视5秒轮询
$app->post('app_teacher_login_tv','TVController@AppTeacherLoginTV'); //电视登陆
$app->post('app_quit_tv','TVController@AppQuitTV');
$app->post('app_tv_ad','TVController@AppTVAD');
$app->post('app_tv_encryption_code','TVController@tvEncryptionCode');
$app->post('app_class_ending','TVController@ClassEnding');

$app->post('book/add','BookController@add');
$app->post('book/list','BookController@actionList');


