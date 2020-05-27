<?php
/**
 * Created by PhpStorm.
 * User: zhaojia
 * Date: 2020/5/26
 * Time: 9:56 AM
 */
namespace App\Http\Controllers\AppApi\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\User;
use App\Http\Libraries\ResultHelper;
use App\Http\Libraries\ResultCode;

class UserController extends Controller{

    public function getUserDetail(Request $request){
        return 1;

//        $model = User::where('id',1)->first();
//
//        return ResultHelper::resultAppNothing(ResultCode::$success,$model);
    }
}