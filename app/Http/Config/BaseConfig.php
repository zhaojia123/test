<?php
/**
 * Created by PhpStorm.
 * User: lirui
 * Date: 2018/1/9
 * Time: 下午5:02
 */

namespace App\Http\Config;


class BaseConfig
{
    public static $mechanismID = '';
    public static $schoolID = '';
    public static $token = '';
    public static $userID = 0;
    public static $v = '';
    public static $t = '';

    const PAGE = 20;

    const RECOMMEND_PLACE_CENTER = [1=>'首页',2=>'发现',3=>'商城'];
    const RECOMMEND_PLACE_HOME_MODULE = [1=>'轮播图',2=>'新品推荐',3=>'头条',4=>'名师专栏',5=>'推荐学习',6=>'大师课堂',7=>'今日课程',8=>'直播教学',9=>'新专上架',10=>'本周之星',11=>'最新作业'];
    const RECOMMEND_PLACE_FIND_MODULE = [1=>'轮播图',2=>'限时特惠',3=>'为你定制',4=>'最新上架',5=>'大家都在练'];
    const RECOMMEND_PLACE_MALL_MODULE = [1=>'轮播图',2=>'限时特惠',3=>'热门商品',4=>'猜你喜欢'];

    const RECOMMEND_PLACE_HOME_MODULE_NO_SHOW = ['今日课程','直播教学','新专上架','本周之星','最新作业'];
    const RECOMMEND_PLACE_FIND_MODULE_NO_SHOW = [];
    const RECOMMEND_PLACE_MALL_MODULE_NO_SHOW = [];

    /// 轮播图跳转类型
    ///
    /// - h5: h5(轮播图、头条、名师专栏、广告)
    /// - textbook: 教材（轮播图、为你定制、最新上架、大家都在练、广告、推荐学习、当前学习）
    /// - lesson: 教学视频（广告、推荐学习、当前学习）
    /// - live: 直播（广告）
    /// - shop: 商城商品（热门商品、猜你喜欢、广告、新品推荐）
    /// - master: 大师频道（大师讲堂、推荐学习）
    /// - movement: 乐曲（新专上架、当前学习）
    /// - smallVideo: 小视频（本周之星、最新作业）
    /// - attendClass: 上课内容（当前学习）
    /// - remarkHomework : 点评作业
    /// - playback : 回放
    /// - preparation : 预告
//    const RECOMMEND_PALACE_CONTENT_TYPE = [ 1=>'h5',2=>'textbook',3=>'lesson',4=>'live',5=>'shop',6=>'master',7=>'movement',8=>'smallVideo',9=>'attendClass',10=>'remarkHomework',11=>'playback',12=>'preparation'];
    const RECOMMEND_PALACE_CONTENT_TYPE = [ 1=>'h5',2=>'教材',3=>'教学视频',4=>'直播',5=>'商城商品',6=>'大师频道',7=>'乐曲',8=>'小视频',9=>'上课内容',10=>'点评作业',11=>'回放',12=>'预告'];

    //课件资源类型
    const COURSEWARE_RESOURCE_TYPE = [1=>'板书',2=>'视频',3=>'跟谱'];

    //教材资源类型
    const TEXTBOOK_RESOURCE_TYPE = [1=>'视频',2=>'跟谱'];

    //校区类型
    const SCHOOL_TYPE = [1=>'直营',2=>'加盟'];

    //机构企业性质
    const MECHANISM_TYPE = [1=>'企业法人',2=>'非企业法人(含个体工商户)'];

    //校区状态
    const SCHOOL_STATUS = [1=>'通过',2=>'拒绝',3=>'审核中'];

    //库存预警手机号
    const MESSAGE_PHONE = '18511582044';

    //快递公司
    const DELIVERY_COMPANY = [1=>'顺丰速递',2=>'圆通快递',3=>'申通快递',4=>'中通快递',5=>'韵达快递',6=>'百世汇通',7=>'德邦快递'];

    //商品订单状态
    const GOODS_ORDER_STATUS = ['未付款','已付款','已发货','已完成','已关闭'];

    //直播状态
    const LIVE_STATUS = ['未开播','直播中','已结束'];

    //直播推流类型
    const LIVE_PUSHING_TYPE = ['手机横屏/OBS','手机竖屏'];

    //会员VIP价格
    const ANDROID_VIP_PRICE = 365;
    const IOS_VIP_PRICE = 548;

    //会员VIP功能列表
    const VIP_LIST = [['name'=>'免费课程库','cover_url'=>''],['name'=>'免费直播课','cover_url'=>''],['name'=>'免费曲库','cover_url'=>''],['name'=>'去广告','cover_url'=>''],['name'=>'付费功能折扣','cover_url'=>''],['name'=>'尊贵标示','cover_url'=>'']];

    //支付方式
    const PAY_OS_IOS = 1;
    const PAY_OS_ANDROID = 2;
    const PAY_OS_WX = 3;
    const PAY_OS_IOS_S = 'iPhone';
    const PAY_OS_ANDROID_S = 'android';
    const PAY_OS_WX_S = 'wx';
    const PAY_OS_ARRAY = ['ios'=>1,'android'=>2,'wx'=>3];

    //订单号后缀类型
    const PAY_POSTFIX_ARRAY = ['MALL','VI','CO'];
    const ORDER_TYPE_MALL = 'MALL'; //商城
    const ORDER_TYPE_COIN = 'CO'; //金币
    const ORDER_TYPE_VIP = 'VI'; //会员

    //beecloud支付方式
    const PAY_TYPE = ['WX'=>1,'ALI'=>2,'UN'=>3,'KUAIQIAN'=>4,'JD'=>5,'BD'=>6,'YEE'=>7,'PAYPAL'=>8,'BC'=>9,'iPhone'=>10];

    const PAY_TYPE_DEE_CLOUD = 9;

    //支付状态
    const PAY_STATUS_UNPAID = 0; //未支付
    const PAY_STATUS_FINISH = 1; //已支付
    const PAY_STATUS_ING = 2; //支付中

    //操作系统
    const OS_IOS = 1;
    const OS_ANDROID = 2;
    const OS_OTHER = 3;

    //教师推荐活动时间
    const  RECOMMEND_TEACHER_COIN_START_DATE = '2017-12-10 00:00:01';
    const  RECOMMEND_TEACHER_COIN_END_DATE = '2018-01-31 23:59:59';

    //金币系统

    //是否允许提现标示
    const COIN_ALLOW_WITHDRAWALS = true; //允许提现
    const COIN_NOT_ALLOW_WITHDRAWALS = false; //不允许提现

    //金币流水改变类型
    const COIN_OPERATION_TYPE_ADD = 1; //金币流水改变方式增加
    const COIN_OPERATION_TYPE_REDUCE = 2; //金币流水改变方式减少
    const COIN_OPERATION_TYPE_ARRAY = ['增加','减少'];

    //金币流水类型
    const COIN_FROM_TYPE_RECHARGE = 1; //充值
    const COIN_FROM_TYPE_LIVE = 2; //直播
    const COIN_FROM_TYPE_WITHDRAWALS = 3; //提现
    const COIN_FROM_TYPE_SEND_GIFT = 4; //送礼物
    const COIN_FROM_TYPE_RECEIVE_GIFT = 5; //收礼物
    const COIN_FROM_TYPE_REBATE_COIN_TEACHER = 6; //充值会员教师返金币
    const COIN_FROM_TYPE_REBATE_COIN_STUDENT = 7; //充值会员学生返金币
    const COIN_FROM_TYPE_BUY_ALBUM = 8; //专辑购买
    const COIN_FROM_TYPE_BUY_ALBUM_MUSIC = 9; //专辑乐曲购买
    const COIN_FROM_TYPE_ACTIVITY_CHRISTMAS_LUCK_TEACHER = 10; //圣诞节教师抽奖
    const COIN_FROM_TYPE_ACTIVITY_CHRISTMAS_LUCK_VIP_CHARGER = 11; //圣诞节VIP抽奖
    const COIN_FROM_TYPE_ARRAY = ['充值','直播','提现','送礼','收礼','教师返金币','学生返金币','购买专辑','购买专辑乐曲','圣诞节教师抽奖返金币','圣诞节VIP充值返金币']; //充值提现

    //金币流水增加类型
    const COIN_OPERATION_TYPE_ADD_RECHARGE = 1; //充值
    const COIN_OPERATION_TYPE_ADD_RECEIVE_GIFT = 5; //收礼物
    const COIN_OPERATION_TYPE_ADD_REBATE_COIN_TEACHER = 6; //充值会员教师返金币
    const COIN_OPERATION_TYPE_ADD_REBATE_COIN_STUDENT = 7; //充值会员学生返金币
    const COIN_OPERATION_TYPE_ADD_ACTIVITY_CHRISTMAS_LUCK_TEACHER = 10; //圣诞节教师抽奖
    const COIN_OPERATION_TYPE_ADD_ACTIVITY_CHRISTMAS_LUCK_VIP_CHARGER = 11; //圣诞节VIP抽奖返金币

    //金币流水减少类型
    const COIN_OPERATION_TYPE_REDUCE_LIVE = 2; //直播
    const COIN_OPERATION_TYPE_REDUCE_WITHDRAWALS = 3; //提现
    const COIN_OPERATION_TYPE_REDUCE_GIFT = 4; //送礼物
    const COIN_OPERATION_TYPE_REDUCE_BUY_ALBUM = 8; //专辑购买
    const COIN_OPERATION_TYPE_REDUCE_BUY_ALBUM_MUSIC = 9; //专辑乐曲购买

    //推荐获取的金币数量
    const RECOMMEND_COIN = 400; //教师推荐返现显示用最高可获取多少
    //const RECOMMEND_COIN_ = rand(200,400); //实际推荐金币收益随机200-400之间
    const RECOMMEND_COIN_STUDENT = 200; //学生推荐返现金币数

    //会员系统
    //会员流水类型
    const VIP_FROM_TYPE_RECHARGE = 1; //充值
    const VIP_FROM_TYPE_ARRAY = ['充值']; //充值
    //会员流水改变类型
    const VIP_OPERATION_TYPE_ADD = 1; //会员流水改变方式增加
    //会员流水增加类型
    const VIP_OPERATION_TYPE_ADD_RECHARGE = 1; //充值

    //金币流水分页最多获取数量
    const COIN_DETAIL_LENGTH = 50;
    const ADMIN_WITHDRAWALS_LIST_LENGTH = 20;

    //提现金币与现金比例
    const COIN_CASH_PROPORTION = 15; //15金币换1元

    //提现最少金额
    const MIN_WITHDRAWALS_MONEY = 100; //最少提现20元

    //提现手续费
    const WITHDRAWALS_POUNDAGE = 2; //提现手续费，每笔2元
    //每周最大提现次数
    const MAX_WITHDRAWALS_COUNT = 1;

    //提现状态
    const WITHDRAWALS_STATUS_FINISH = 1; //成功
    const WITHDRAWALS_STATUS_ING = 2; //提现中
    const WITHDRAWALS_STATUS_FAIL = 3; //失败

    const USER_PROTOCOL = 'http://www.9beats.com/user_protocol.html'; //会员协议
    const USER_RECHARGE_PROTOCOL = 'http://www.9beats.com/user_pay.html'; //用户充值协议
    const VIDEO_COURSE_SHARED_URL = 'http://living.9beats.com/course/'; //视频课程分享链接
    const GOODS_SHARED_URL = 'http://www.9beats.com/h5/goods_content.php?id='; //视频课程分享链接
    const LIVE_SHARED_URL = 'http://living.9beats.com/validation/'; //直播分享地址


}


define('BEECLOUD_APPID','f8a978ea-4ccd-4431-adb2-11b47d2122e6');
if(env('APP_DEBUG')){
    define('BEECLOUD_APPSECRET','ce22dded-c584-4a6e-bb7c-6b3b671de48a'); //测试
    define('UNJP_URL','api.9beatsusa.com'); //测试
}else{
    define('BEECLOUD_APPSECRET','8c636cd4-41f5-48b2-ad83-b3056f0ea8fb'); //正式
    define('UNJP_URL','api.9beatsusa.com'); //正式
}

define('RECOMMEND_COIN_RANGE',rand(200,400));//教师推荐返现实际推荐金币收益随机200-400之间
define('WITHDRAWALS_STATUS_ARRAY' , ['成功'=>1,'提现中'=>2,'失败'=>3]);

define('DEFAULT_HEADIMAGE','http://cdn.9beats.com/app/headimg.png');
define('DEFAULT_BGIMG','http://cdn.9beats.com/app/placeholder.png');
define('SERVICE_URL','http://service.9beats.com/');
define('CLASS_BACKGROUND','http://cdn.9beats.com/app/banji.png');

//直播相关
define('LOVETTL',30);
define('BIZID','56264');
define('VURL','http://living.9beats.com/');
define('CREATEGROUPURL','https://console.tim.qq.com/v4/group_open_http_svc/create_group?');
define('MESSAGEGROUPURL','https://console.tim.qq.com/v4/group_open_http_svc/send_group_msg?');
define('SERVICEURL','http://service.9beats.com/get-sig.php?');
define('GROUPADMIN','admin123');
define('GROUPAPPID','1400234389');
define('LIVE_API_KEY','acd3366b25ad795ced3f33c0a301efb6');
define('LIVE_APPID','1252905615');