<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    /**
     * 发送请求
     * @param  [type] $url        url 地址
     * @param  [type] $data       提交的数据
     * @param  array  $httpHeader head 头
     * @return [type]             返回结果，false 失败
     */
    public  function postCurl($url, $data, $httpHeader = array(),$result = false,$time = 30) {
        $ch = curl_init();
        $strReg = '/application\/json/i';
        if (count($httpHeader) > 0 && preg_match($strReg, $httpHeader[0])) {
            $data = json_encode($data, true);
        } else {
            $data = http_build_query($data);
            $data = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $data);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time);
        curl_setopt($ch, CURLOPT_USERAGENT, "curl/7.19.7 (x86_64-redhat-linux-gnu) libcurl/7.19.7 NSS/3.15.3 zlib/1.2.3 libidn/1.18 libssh2/1.4.2");

        $strResult = curl_exec($ch);
        $rInfo = curl_getinfo($ch);
        curl_close($ch);
        if ($result)
            return $strResult;
        if ($rInfo['http_code'] == '200') {
            $arrResult = json_decode($strResult, true);
        } else {
            return false;
        }
        return $arrResult;
    }
}
