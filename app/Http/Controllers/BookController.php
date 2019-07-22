<?php

namespace App\Http\Controllers;

use App\Http\Model\WriteBook;
use Illuminate\Http\Request;
use Exception;

class BookController extends Controller
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

    public function add(Request $request)
    {
        $params = $request->get('params');
//        $mechanism_id = $request->get('mechanism_id');
//        $courseware_id = $request->get('courseware_id');
//        $resource_id = $request->get('resource_id');
//        $url = $request->get('url');
        try {
            $params = json_decode($params,true);
            if (empty($params))
                throw new Exception('数据错误');
            $model = new WriteBook();
            $params['created_at'] = time();
            $is = $model->insert($params);
            if (!$is)
                throw new Exception('保存失败');

        } catch (Exception $e) {
            $this->results['code'] = $e->getCode();
            if ($e->getCode() == 0)
                $this->results['code'] = 5000;
            $this->results['message'] = $e->getMessage();
        }

        return json_encode($this->results,JSON_UNESCAPED_UNICODE);

    }

    public function actionList(Request $request)
    {
        $user_id = $request->get('user_id');

        try {

            $model = new WriteBook();

            if (!empty($user_id))
                $model = $model->where('user_id',$user_id);

            $data = $model->get();

            $this->results['data'] = $data;
        } catch (Exception $e) {
            $this->results['code'] = $e->getCode();
            if ($e->getCode() == 0)
                $this->results['code'] = 5000;
            $this->results['message'] = $e->getMessage();
        }

        return json_encode($this->results,JSON_UNESCAPED_UNICODE);

    }
}
