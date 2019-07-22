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

class WriteBook extends Model {

    protected $table = 'write_book';
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

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'mechanism_id',
        'user_id',
        'courseware_id',
        'resource_id',
        'url',
        'created_at',
    ];


}