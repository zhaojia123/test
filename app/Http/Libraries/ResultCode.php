<?php
/**
 * Created by PhpStorm.
 * User: zhaojia
 * Date: 2020/5/26
 * Time: 10:45 AM
 */
namespace App\Http\Libraries;


class ResultCode
{
    public static $success = ['code'=>0,'message'=>'成功'];
    public static $tokenFail = ['code'=>1,'message'=>'登录状态已失效，请重新登录'];
    public static $handleFail = ['code'=>2,'message'=>'操作失败'];
}