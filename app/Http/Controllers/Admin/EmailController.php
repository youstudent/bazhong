<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/11
 * Time: 下午4:03
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Model\Business;
use App\Http\model\Category;
use App\Http\Model\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $model = new Email();
        $data = $model->getList($request->all());
        return view('email.index',$data);
    }


    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request){
        if ($request->isMethod('post')){
            $model = new Email();
            if ($model->add($request)){
                return redirect('/admin/email/index');
            }
            return redirect('/admin/email/create');
        }else{
            $category =Category::select(['id','category_name'])->where('pid',0)->get()->toArray();
            return view('email.create',['category'=>$category]);
        }
    }


    public function sonCategory(Request $request){
        $id =$request->get('id');
        $business = Business::select(['id','name'])->where('category_id',$id)->get()->toArray();
        return ['code'=>1,'message'=>'成功','data'=>$business];

    }

}