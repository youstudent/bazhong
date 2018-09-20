<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/11
 * Time: 下午5:06
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\ClientUsers;
use App\Http\Model\Ptc;
use Illuminate\Http\Request;

class ClientUsersController extends Controller
{
    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $model = new ClientUsers();
        $data = $model->getList($request->all());
        return view('client_users.index',$data);
    }


    /**
     * 打卡记录
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cardRecord(Request $request){
        $model = new Ptc();
        $data = $model->getList($request->all());
        return view('client_users.card_record',$data);
    }

}