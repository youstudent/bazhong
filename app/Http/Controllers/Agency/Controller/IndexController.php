<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/13
 * Time: 下午3:52
 */

namespace App\Http\Controllers\Agency\Controller;

use App\Http\Controllers\Agency\Model\Business;
use Illuminate\Http\Request;
class IndexController extends AgencyController
{
    /**
     * 首页中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View'
     */
    public function index(Request $request){
        $model = new Business();
        $data = $model->getCount();
        if ($request->method() =='POST'){
             $model->add($request);
            return redirect('/agency/index/index');
        }
        return view('agency.index.index',$data);
    }


    /**
     * 邮件消息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function message(Request $request){
        $model = new Business();
        $data = $model->getList($request->all());
        return view('agency.index.message',$data);
    }


    public function qrcode(){

        return view('agency.index.qrcode');
    }

}