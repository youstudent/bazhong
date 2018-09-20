<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/10
 * Time: 下午6:00
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Banner;
use App\Http\Model\BannerSign_up;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $model = new Banner();
        $data = $model->getList();
        return view('banner.index',$data);
    }


    /**
     * 修改
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Request $request){
        if ($request->isMethod('post')){
            $model = new Banner();
            if ($model->edit($request)){
                return redirect('/admin/banner/index');
            }
            return redirect('/admin/banner/edit?id='.$request->get('id'));
        }else{
            $data = Banner::find($request->get('id'));
            return view('banner.edit',['data'=>$data]);
        }

    }

    /**
     * 报名记录
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function record(Request $request){
        $model = new BannerSign_up();
        $data = $model->getList($request->all());
        return view('banner.record',$data);
    }

}