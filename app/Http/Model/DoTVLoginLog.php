<?php
/**
 * Created by PhpStorm.
 * User: mayan
 * Date: 2018/4/23
 * Time: 下午4:32
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DoTVLoginLog extends Model {

    protected $table = 'do_tv_login_log';
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * 模型的日期字段的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';
//    const CREATED_AT = 'creation_date';
//    const UPDATED_AT = 'last_update';
    /**
     * 此模型的连接名称。
     *
     * @var string
     */
    protected $connection = 'tvSql';
//`id` int(11) NOT NULL AUTO_INCREMENT,
//`tv_id` varchar(512) NOT NULL DEFAULT 0 COMMENT '电视ID',
//`user_id` varchar(128) NOT NULL DEFAULT '' COMMENT '教师ID',
//`latitude` FLOAT not null default 0 comment '维度',
//`longitude` FLOAT not null default 0 comment '经度',
//`addr` varchar(512) not null default '' comment '地址',
//`time` int(11) not null default 0 comment '时间',
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'tv_id',
        'user_id',
        'latitude',
        'longitude',
        'addr',
        'time',
    ];


}