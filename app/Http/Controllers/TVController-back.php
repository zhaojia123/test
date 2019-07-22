<?php
/**
 * Created by PhpStorm.
 * User: lirui
 * Date: 2018/3/13
 * Time: 下午2:01
 */

namespace App\Http\Controllers;


use App\Http\Model\DoTVLoginLog;
use App\Http\Model\TVAd;
use App\Http\Model\TVPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Exception;

class TVControllerback extends Controller
{
    public $url = 'http://api.9beats.com';
    public $newUrl = 'http://api.wedomusic.cn';
    public $vipList = [
        '82192057',
        '57456559',
        '68071079',
        '75818019',
        '51',
    ];
    public $message = ['ret'=>0,
        'message'=>'ok',
        'data'=>null,
    ];

    public function __construct(Request $request)
    {
        $t = $request['t'];
        $v = $request['v'];
        $f = $request['f'];
        // $f 为空的话，访问tv接口
        if (empty($f))
            $this->url = WEDOMUSIC;
        else
            $this->url = BEATS9;
    }

    public function AppTVPolling(Request $request){

        $code = $request['code'];
        $currentVersion = $request['current_version'];
        $tv_type = $request->get('dev_type');

        Redis::zadd('tv_test',time(),$code);

        //轮询时间间隔
        $data['ttl'] = 5;
        if($currentVersion == 1006){
            //查询电视是否绑定教师
            $data['userid'] = 111;

            //获取token
            $data['token'] = 2222;
        }else{
            //校验是否存在这个电视的绑定记录
            if(!Redis::exists('tv_bind_teacher_'.$code)){
                //如果不存在生成这个电视的绑定记录
                Redis::set('tv_bind_teacher_'.$code,0);
                $data['userid'] = 0;
                return array('ret'=>0,'message'=>null,'data'=>$data);
            }
            //查询电视是否绑定教师
            $data['userid'] = Redis::get('tv_bind_teacher_'.$code);

            //获取token
            $data['token'] = json_decode(Redis::get('user_'.$data['userid']),true)['token'];
            //$data['token'] = $this->AppValidateUser($data)['token'];

        }


        date_default_timezone_set('prc');
        $data['time'] = time();
        $data['dev_type'] = $tv_type;  //10 哆来学  11 九拍  12 上大
        $data['new_url'] = null;
        $data['force_update'] = 0;
        $data['version'] = 0;
        $data['intact_code']= 0;
        $data['is_dev_type'] = 0;  // 1切换版本  0 不切换
        $data['package_name'] = ''; //app包名

        //通过电视唯一标识获取redis中存储的 系统版本，
        // 1、redis没值，不切换。2、redis有值，并和当前传过来的不一致，则切换。
        $m_type = Redis::hget('tv_dev_type',$code.$tv_type);
        if (!empty($m_type)){
            if ($tv_type != $m_type){
                $data['is_dev_type'] = 1;  // 1切换版本  0 不切换
                $data['dev_type'] = $m_type;
                //取最新版本
                $NewVersion = $this->NewVersion($data['dev_type']);
                $data = array_merge($data,$NewVersion);
            }else{
                Redis::hdel('tv_dev_type',$code.$tv_type);
            }
        }
        //$NewVersion 不为空，则是切换。版本信息已是最新
        //$NewVersion 为空，则不切换。从redis中取得最新的版本，再判断当前版本是否为最新，如果不是，则取最新版本
        if (empty($NewVersion)){
            $NewVersion = $this->NewVersion($data['dev_type']);
            if ($currentVersion < $NewVersion['version']){
                $data = array_merge($data,$NewVersion);
            }
        }


        if(strstr($code,'04:e6:76:25:25:3c')){
            $i = 1;
        }elseif(strstr($code,'6c:60:eb:02:92:6a')){
            $i = 1;
        }elseif(strstr($code,'b0:f1:ec:9d:98:82')){
            $i = 1;
        }else{
            $i = 1;
        }
        $data['is_debug'] =  $i;
        return array('ret'=>0,'message'=>null,'data'=>$data);
    }
    /**
     * 电视切换系统的回调接口
     * @param $request
     * @return array
     */
    public function AppTvPackageSwitch(Request $request)
    {
        $code = $request['code'];
        $tv_type = $request->get('dev_type');
        Redis::hdel('tv_dev_type',$code.$tv_type);
        return array('ret'=>0,'message'=>null,'data'=>null);
    }

    /**
     * 获取执行类型的 原始版
     * @param $dev_type [电视的类型：10 哆来学  11 九拍  12 上大]
     * @return array    [new_url：下载地址，force_update：，version：版本号，
     *                   package_name：包名，intact_code：包的完整性验证码]
     */
    private function originalVersion($dev_type){
        $data = [];
        switch ($dev_type) {
            case 10:
                //增加最新版本判断
                $data['new_url'] = 'http://cdn.9beats.com/tv_10_1023.apk';
                $data['force_update'] = 0;
                $data['version'] = 1023;
                $data['package_name'] = 'com.wodomusic.wedomusictvr';
                $data['intact_code'] = '92c2b6375309ee3a06ddf354fbf5d3ede83298fc';

                break;
            case 11:
                $data['new_url'] = 'http://cdn.9beats.com/tv_11_1023.apk';
                $data['force_update'] = 0;
                $data['version'] = 1023;
                $data['intact_code'] = '590546c1a3397ea5db5f04864a9be97eb7ee42b';
                $data['package_name'] = 'ninebeatsteachertv.jiupai.com';
                break;
            case 12:
                $data['new_url'] = 'http://cdn.wedomusic.cn/tv_package/tv_12_1025.apk';
                $data['force_update'] = 0;
                $data['version'] = 1025;
                $data['package_name'] = 'com.shangdamarimba.tv';
                $data['intact_code'] = '95ae668e03d62c2f0d7f06b66c7886944ffdc5e0';
                break;
        }
        return $data;
    }
    public function TvNewVersion(Request $request)
    {
        $data = $this->NewVersion($request['dev_type']);

        if (empty($data))
            $results =  array('ret'=>1,'message'=>'获取版本信息失败','data'=>null);
        else
            $results =  array('ret'=>0,'message'=>null,'data'=>$data);
        return $results;

    }


    /**
     * 获取执行类型的 最新版本信息
     * @param $dev_type [电视的类型：10 哆来学  11 九拍  12 上大]
     * @return array    [new_url：下载地址，force_update：，version：版本号，
     *                   package_name：包名，intact_code：包的完整性验证码]
     */
    private function NewVersion($dev_type){
        $data = [];
        switch ($dev_type) {
            case 10:
                //增加最新版本判断
                $data['new_url'] = 'http://cdn.9beats.com/tv_10_1023.apk';
                $data['force_update'] = 0;
                $data['version'] = 1023;
                $data['package_name'] = 'com.wodomusic.wedomusictvr';
                $data['intact_code'] = '92c2b6375309ee3a06ddf354fbf5d3ede83298fc';

                break;
            case 11:
                $data['new_url'] = 'http://cdn.wedomusic.cn/tv_package/tv_11_1027.apk';
                $data['force_update'] = 0;
                $data['version'] = 1027;
                $data['intact_code'] = '2a2dc95db4241087aa9cbb66ee0fe8bcc7a10917';
                $data['package_name'] = 'ninebeatsteachertv.jiupai.com';
                break;
            case 12:
                $data['new_url'] = 'http://cdn.wedomusic.cn/tv_package/tv_12_1026.apk';
                $data['force_update'] = 0;
                $data['version'] = 1026;
                $data['package_name'] = 'com.shangdamarimba.tv';
                $data['intact_code'] = 'd1075e86115454351ed77832094b6e2ac81185dd';
                break;
        }
        $data = TVPackage::where('mechanism_id',$dev_type)
            ->where('type','new')
            ->select(['new_url','force_update','version','package_name','intact_code'])
            ->first();

        $data = empty($data) ? [] : $data->toArray();

        return $data;
    }

    private function AppValidateUser($data,$url = '')
    {
        $results = $this->postCurl($url,$data);
        if ($results['ret'] === 0){
            $userData = $results['data'];
        }else{
            $userData = false;
        }
        return $userData;
    }

    private function newAppValidateUser($data,$url = '')
    {
        $results = $this->postCurl($url,$data,true);
        if ($results['code'] === 0){
            $userData = $results['data'];
            $userData['token'] = $results['token'];
        }else{
            $userData = false;
        }

        return $userData;
    }

    public function AppTeacherLoginTV(Request $request){

        $tvInfo = json_decode($request['code'],true);
        $code = $tvInfo['tv_id'];
        $t = $request['t'];
        $v = $request['v'];
        $f = $request['f'];
        $userid = $request['userid'];
        $token = $request['token'];
        $latitude = $request['latitude'];
        $longitude = $request['longitude'];

        //校验二维码是否有记录
        //把传过来的json md5，然后查找
        $qrCode = md5($request['code']);
        try {
            //通过code里的变量判断是新老电视
            if (empty($tvInfo['app_channel_code']))
                throw new Exception('您正在用新版App登陆旧版本的电视系统',2);
            if(Redis::zscore('tv_qr_code',$qrCode)){
                throw new Exception('二维码失效,请重试!',2);
            }
            //验证用户信息
            $validate_url = $this->url.'/app_validate_user?t='.$t.'&v='.$v.'&f='.$f;

            //新老接口交替
            if (empty($f)){
                $data = [
                    'user_id' => $userid,
                    'token' => $token,
                ];
                $userData = $this->newAppValidateUser($data,$validate_url);
                if (empty($userData))
                    throw new Exception('用户不存在',1);
                Redis :: set('user_' . $data['user_id'],json_encode($userData));

                $isAllow = $userData['user_type_id'];
            } else{
                $data = [
                    'userid' => $userid,
                    'token' => $token,
                ];
                $userData = $this->AppValidateUser($data,$validate_url);
                if (empty($userData))
                    throw new Exception('用户不存在',1);
                Redis :: set('user_' . $data['userid'],json_encode($userData));
                $isAllow = $userData['data']['usertype'];
            }
            //校验该用户是否有权限
            if($isAllow < 1){
                throw new Exception('该用户没有权限',2);
            }

            //查询教师是否绑定电视
            //先查询所有tv_bind_teacher_*的key
            $keys = Redis::keys('tv_bind_teacher_*');
            foreach($keys as $key=>$value){
                if('tv_bind_teacher_'.$code != $value ){
                    //再遍历所有的key，取出里面的值，和当前传入的用户匹配，如果匹配到则把该电视绑定置为0
                    if(Redis::get($value) == $userid){
                        Redis :: set($value,0);
                    }
                }
            }

            //白名单不切换系统
            if (!in_array($userid,$this->vipList) ){
                //验证手机端和电视端的类型是否匹配，如果类型不匹配。则把 电视需要的类型 保存到redis里
                //返回 正在切换系统的提示，并阻止登陆
                $m_type = empty($request['dev_type']) ? 11 : $request['dev_type'];  //手机端的系统类型,不传默认为（11）九拍老师
                $tv_type = $tvInfo['app_channel_code'];  //电视端的系统类型
                if ($m_type != $tv_type){
                    Redis::hset('tv_dev_type',$code.$tv_type,$m_type);
                    return array('ret'=>2,'message'=>'正在切换系统，请稍等','data'=>null);
                }
            }

            //先查询教师是否有绑定的电视
            $isTeacherBind = Redis::get('teacher_bind_tv_'.$userid);
            //如果绑定先解绑
            if($isTeacherBind){
                Redis::set('teacher_bind_tv_'.$userid,0);
            }
            $isTVBind = Redis::get('tv_bind_teacher_'.$code);
            if($isTVBind){
                Redis::set('tv_bind_teacher_'.$code,0);
            }
            //绑定机器码和教师
            Redis::set('tv_bind_teacher_'.$code,$userid);
            Redis::set('teacher_bind_tv_'.$userid,$code);

            //插入登陆信息日志
            $data = [
                'tv_id' => $code,
                'user_id' => $userid,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'time' => time()
            ];
            $tv_log = DoTVLoginLog::create($data);

            //存入二维码
            Redis::zadd('tv_qr_code',1,$qrCode);
        } catch (Exception $e) {
            $this->message['ret'] = $e->getCode();
            $this->message['message'] = $e->getMessage();
        }

        return $this->message;
    }

    public function AppQuitTV(Request $request){
        $code = $request['code'];
        $userid = $request['userid'];
        $token = $request['token'];
        $t = $request['t'];
        $v = $request['v'];
        $f = $request['f'];
        try {
            //验证用户信息
            $validate_url = $this->url.'/app_validate_user?t='.$t.'&v='.$v.'&f='.$f;
            //新老接口交替
            if (empty($f)){
                //新接口
                $data = [
                    'user_id' => $userid,
                    'token' => $token,
                ];
                $userData = $this->newAppValidateUser($data,$validate_url);
//                if (empty($userData))
//                    throw new Exception('用户不存在',11);
//                if ($data['user_id'] != $userData['id'])
//                    throw new Exception('user_id 不正确');

                $isAllow = $userData['user_type_id'];
            } else{
                $data = [
                    'userid' => $userid,
                    'token' => $token,
                ];
                $userData = $this->AppValidateUser($data,$validate_url);
//                if (empty($userData))
//                    throw new Exception('用户不存在',12);
//                $isAllow = $userData['data']['usertype'];
            }
            //校验该用户是否有权限
//            if($isAllow < 1){
//                throw new Exception('该用户没有权限',21);
//            }

            //先查询教师是否有绑定的电视
            $isTeacherBind = Redis::get('teacher_bind_tv_'.$userid);
            //如果绑定则解绑
            if($isTeacherBind){
                Redis::set('teacher_bind_tv_'.$userid,0);
            }
            $isTVBind = Redis::get('tv_bind_teacher_'.$code);
            if($isTVBind){
                Redis::set('tv_bind_teacher_'.$code,0);
            }

            date_default_timezone_set('prc');
            $this->message['data'] = ['time'=>time()];

        } catch (Exception $e) {
            $this->message['ret'] = $e->getCode();
            $this->message['message'] = $e->getMessage();
        }

        return $this->message;

        //return array('ret'=>0,'message'=>null,'data'=>['time'=>time()]);
    }

    public function AppTVAD(Request $request){
        $mechanism_id = $request['mechanism_id'];
//        $currentType = 1; //图片
//        $currentType = 2; //动图
       // $currentType = 3; //视频
        $type = 'video';
        try {
            $ad = TVAd::where('mechanism_id',$mechanism_id)
                ->where('type',$type)
                ->select('mechanism_id','url','type','ttl')
                ->first();
            $this->message['data'] = $ad;

        } catch (Exception $e) {
            $this->message['ret'] = $e->getCode();
            $this->message['message'] = $e->getMessage();
        }

        return $this->message;

        switch($currentType){
            case 1:
                return array('ret'=>0,'message'=>null,'data'=>['url'=>'http://tv-package.oss-cn-beijing.aliyuncs.com/oil.jpg','type'=>'img','ttl'=>10]);
                break;
            case 2:
                return array('ret'=>0,'message'=>null,'data'=>['url'=>'http://tv-package.oss-cn-beijing.aliyuncs.com/db8a54acc6e6594ad8ca83d5886504d0.gif','type'=>'gif','ttl'=>10]);
                break;
            case 3:
                return array('ret'=>0,'message'=>null,'data'=>['url'=>'http://tv-package.oss-cn-beijing.aliyuncs.com/WeChatSight846.mp4','type'=>'video','ttl'=>10]);
                break;
        }
    }
    public function tvEncryptionCode(){
        return ['ret'=>0,'message'=>4269,'data'=>null];
    }

    public function ClassEnding(Request $request){

        $teacher_id = $request['teacher_id'];
        $token = $request['token'];
        $class_id = $request['class_id'];
        $class_number = $request['class_number'];
        $params = [
            'teacher_id' => $request['teacher_id'],
            'token' => $request['token'],
            'class_id' => $request['class_id'],
            'class_number' => $request['class_number'],
        ];
        $url = $this->url.'/app_class_ending';
        $results = $this->postCurl($url,$params);


        return $results;

    }
}