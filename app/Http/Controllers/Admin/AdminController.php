<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/17
 * Time: 下午4:58
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * 管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $data = User::select(['id','name','email','created_at'])->orderBy('id','desc')->get()->toArray();
        return view('auth.index',['datas'=>$data]);
    }


    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request){
        if ($request->isMethod('post')){
            $model = new User();
            if ($model->add($request->all())){
                return redirect('admin/index');
            }
            return redirect('admin/create');
        }else{
            return view('auth.register');
        }
    }


    /**
     * 删除
     * @param $id
     * @return array
     */
    public function delete($id){
        if ($id){
             //User::find($id)->delete();
            return ['code'=>1,'message'=>'删除成功'];
        }
        return ['code'=>0,'message'=>'数据不存在!'];
    }


    /**
     * 修改
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Request $request){
        if ($request->isMethod('post')){
            $model = new User();
            if ($model->edit($request->all())){
                return redirect('admin/index');
            }
            return redirect('admin/edit?id='.$request->get('id'));
        }else{
            $data = User::find($request->get('id'));
            return view('auth.edit',['data'=>$data]);
        }

    }

    /**
     * 修改密码
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editPassword(Request $request){
        $password = $request->get('password');
        if ($password){
            $users = $request->user();
            $users->password = Hash::make($request->get('password'));
            if($users->save()){
                return redirect('/admin/logout');
            }
        }
        return redirect('/admin/index/index');
    }

}