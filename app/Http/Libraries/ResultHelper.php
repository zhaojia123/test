<?php
/**
 * Created by PhpStorm.
 * User: zhaojia
 * Date: 2020/5/26
 * Time: 10:43 AM
 */
namespace App\Http\Libraries;
class ResultHelper{

    public static function resultAppNothing($code,$data=null){
        $result['code'] = $code['code'];
        $result['message'] = $code['message'];
        $result['token'] = '';
        $result['data'] = $data;
        return json_encode($result);
    }

}