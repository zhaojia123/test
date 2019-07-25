<?php

namespace App\Http\Controllers;

use App\Http\Model\WriteBook;
use Illuminate\Http\Request;
use Exception;

class VersionController extends Controller
{
    public $results = [
        'code'  =>  0,
        'message'   =>  'ok',
        'data'  =>  null,
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getIos(Request $request)
    {

        try {
            //登陆，获取token
            $data = $this->postCurl(WEDOMUSIC.'/app_login?app=ios&mechanism_id=11',[
                'phone' => '12345678902',
                'password' => '123456',
            ]);

            $this->results['data'] = [
                'version' => VERSION_IOS,
                'user_id' => $data['data']['id'],
                'token' => $data['token'],
                'imposed_upddate' => 0,
                'message' => '又更新啦啦啦',
                'down_url' => '',
            ];
        } catch (Exception $e) {
            $this->results['code'] = $e->getCode();
            if ($e->getCode() == 0)
                $this->results['code'] = 5000;
            $this->results['message'] = $e->getMessage();
        }

        return json_encode($this->results,JSON_UNESCAPED_UNICODE);

    }


}
