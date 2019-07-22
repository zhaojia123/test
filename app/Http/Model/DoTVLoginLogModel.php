<?php
/**
 * Created by PhpStorm.
 * User: lirui
 * Date: 2017/12/28
 * Time: 上午11:01
 */

namespace App\Http\Model;


use Illuminate\Support\Facades\DB;

class DoTVLoginLogModel
{
//`id` int(11) NOT NULL AUTO_INCREMENT,
//`tv_id` varchar(512) NOT NULL DEFAULT 0 COMMENT '电视ID',
//`user_id` varchar(128) NOT NULL DEFAULT '' COMMENT '教师ID',
//`latitude` FLOAT not null default 0 comment '维度',
//`longitude` FLOAT not null default 0 comment '经度',
//`addr` varchar(512) not null default '' comment '地址',
//`time` int(11) not null default 0 comment '时间',

    private $tableName = 'n_tv_login_log';
    private $tvID = '';
    private $userID = '';
    private $latitude = '';
    private $longitude = '';
    private $addr = '';
    private $time = '';

    private $tvIDField = 'tv_id';
    private $userIDField = 'user_id';
    private $latitudeField = 'latitude';
    private $longitudeField = 'longitude';
    private $addrField = 'addr';
    private $timeField = 'time';

    /**
     * @return string
     */
    public function getTvIDField()
    {
        return $this->tvIDField;
    }


    /**
     * @return string
     */
    public function getUserIDField()
    {
        return $this->userIDField;
    }

    /**
     * @return string
     */
    public function getLatitudeField()
    {
        return $this->latitudeField;
    }

    /**
     * @return string
     */
    public function getLongitudeField()
    {
        return $this->longitudeField;
    }

    /**
     * @return string
     */
    public function getAddrField()
    {
        return $this->addrField;
    }

    /**
     * @return string
     */
    public function getTimeField()
    {
        return $this->timeField;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getTvID()
    {
        return $this->tvID;
    }

    /**
     * @param string $tvID
     */
    public function setTvID($tvID)
    {
        $this->tvID = $tvID;
    }

    /**
     * @return string
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param string $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }


    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * @param string $addr
     */
    public function setAddr($addr)
    {
        $this->addr = $addr;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * 插入数据
     *
     * @param DoTVLoginLogModel $model
     *
     * @return mixed
     */
    public static function insert(DoTVLoginLogModel $model){

        $result = DB::table($model->getTableName())
            ->insertGetId([
                $model->getTvIDField()=>$model->getTvID(),
                $model->getUserIDField()=>$model->getUserid(),
                $model->getLatitudeField()=>$model->getLatitude(),
                $model->getLongitudeField()=>$model->getLongitude(),
                $model->getAddrField()=>$model->getAddr(),
                $model->getTimeField()=>$model->getTime(),
            ]);

        return $result;
    }

}