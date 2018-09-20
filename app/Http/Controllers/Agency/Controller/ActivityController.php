<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/18
 * Time: 下午3:21
 */

namespace App\Http\Controllers\Agency\Controller;


use App\Http\Controllers\Agency\Model\Activity;
use Illuminate\Http\Request;

class ActivityController extends AgencyController
{

    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $model = new Activity();
        $data = $model->getList($request->all());
        return view('agency.activity.index',$data);
    }


    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request){
        if ($request->isMethod('post')){
            $model = new Activity();
            if ($model->add($request)){
                return redirect('/agency/activity/index');
            }
            return redirect('/agency/activity/create');
        }else{
            return view('agency.activity.create');
        }
    }

}