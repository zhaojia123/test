<?php
/**
 * Created by PhpStorm.
 * User: mayan
 * Date: 2018/5/7
 * Time: 下午12:19
 */

namespace App\Console\Commands;



use App\Http\Model\DoTVLoginLog;
use App\Http\Model\DoSchool;
use App\Http\Model\DoTeacherAscriptionSchool;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;


class Test extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command name.
     *
     * @var string
     */
//    protected $name = 'migrate:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'gearman';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->schoole_name();

    }

    public function schoole_name()
    {
        $model = new DoTVLoginLog();
        $modelData = $model
            ->where('id','>=',62260)
            ->select([
                'id',
                'user_id',
            ])->get();

        $school = new DoSchool();
        $ts = new DoTeacherAscriptionSchool();

        foreach ($modelData as $modelDatum) {
            echo $modelDatum['id'].PHP_EOL;

            $schoolData = $school->from($school->getTable().' as s')
                ->leftJoin($ts->getTable().' as t','s.id','=','t.school_id')
                ->where('t.user_id',$modelDatum['user_id'])
                ->select([
                    'name',
                    'liability_name',
                    'liability_phone',
                ])->get()->toArray();

            $name = '';
            $liability_name = '';
            $liability_phone = '';
            foreach ($schoolData as $schoolDatum) {
                $name .= $schoolDatum['name'].'|';
                $liability_name .= $schoolDatum['liability_name'].'|';
                $liability_phone .= $schoolDatum['liability_phone'].'|';
            }
            $name = rtrim($name,'|');
            $liability_name = rtrim($liability_name,'|');
            $liability_phone = rtrim($liability_phone,'|');
            if (!empty($name)){
                $model->where('id',$modelDatum['id'])
//                    ->where('is_delete',0)
                    ->update([
                        'school_name' => $name,
                        'liability_name' => $liability_name,
                        'liability_phone' => $liability_phone,
                    ]);
            }

        }
    }


    public function getaddr()
    {
        //$url = 'http://api.map.baidu.com/geocoder/v2/?callback=renderReverse&output=json&pois=0&latest_admin=1&ak=E76qYTbSE7p2ucv9cmlcZmTMzi2vTmYn&location=37.4127,121.593';
        $url = 'http://api.map.baidu.com/geocoder/v2/?output=json&pois=0&latest_admin=1&ak=E76qYTbSE7p2ucv9cmlcZmTMzi2vTmYn&location=';
        $model = new DoTVLoginLog();
        $modelData = $model->select([
            'id',
            'latitude',
            'longitude',
        ])->where('id','>=',62260)->get();

        foreach ($modelData as $item) {
            $url_p = $url.$item['latitude'].','.$item['longitude'];
            $data = $this->getCurl($url_p);
            $data = json_decode($data,true);
            echo $item['id'].PHP_EOL;

            $model->where('id',$item['id'])
                ->update([
                    'addr' => $data['result']['formatted_address'] . ';' .  $data['result']['sematic_description']
                ]);
        }
    }


    public  function getCurl($url , $params = array(), $httpHeader = []) {
        if (empty($url)) {
            return false;
        }
        if (strpos($url, '?') === false) {
            $url .= '?';
        }else{
            $url .= '&';
        }

        $url .= http_build_query($params,'','&',PHP_QUERY_RFC3986);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //处理http证书问题
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        if ($result === false) {
            $result = curl_errno($ch);
        }
        curl_close($ch);
        return $result;
    }
}

