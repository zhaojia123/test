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
use Illuminate\Support\Facades\Redis;

class DoTeacherAscriptionSchool extends Model {

    protected $table = 'do_teacher_ascription_school';
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
    protected $connection = 'master';



}