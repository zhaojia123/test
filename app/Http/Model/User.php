<?php
/**
 * Created by PhpStorm.
 * User: mayan
 * Date: 2018/4/23
 * Time: 下午4:32
 */
namespace App\Http\Model;



use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "{{example}}".
 *
 * The followings are the available columns in table '{{example}}':
 * @property  $id
 * @property  $mechanism_id
 * @property  $school_id
 * @property  $user_account
 * @property  $phone
 * @property  $password
 * @property  $nick_name
 * @property  $gender
 * @property  $birthday
 * @property  $is_birthday_display
 * @property  $bg_image
 * @property  $user_type_id
 * @property  $name
 * @property  $cert_number
 * @property  $cert_images
 * @property  $graduated
 * @property  $join_date
 * @property  $head_image
 * @property  $city
 * @property  $description
 * @property  $remark
 * @property  $created_at
 * @property  $updated_at
 * @property  $hold_cert_image
 * @property  $cert_image_back
 */
class User extends Model {

    protected $table = 'do_user';
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
    protected $connection = 'mysql';

    protected $fillable = [
        'id',
        'mechanism_id',
        'school_id',
        'openid',
        'user_account',
        'phone',
        'password',
        'nick_name',
        'gender',
        'birthday',
        'is_birthday_display',
        'bg_image',
        'user_type_id',
        'name',
        'cert_number',
        'cert_images',
        'graduated',
        'join_date',
        'head_image',
        'city',
        'description',
        'remark',
        'is_show',
        'is_delete',
        'created_at',
        'updated_at',
        'dd_user_id',
        'hold_cert_image',
        'cert_image_back',
    ];

}