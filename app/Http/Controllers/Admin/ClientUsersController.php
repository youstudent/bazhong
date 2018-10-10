<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/11
 * Time: 下午5:06
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\ApplyRecord;
use App\Http\Model\ClientUsers;
use App\Http\Model\Ptc;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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


    /**
     * 申请经销商记录
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applyRecord(Request $request){
        $model = new ApplyRecord();
        $data = $model->getList($request->all());
        return view('client_users.applyRecord',$data);
    }


    /**
     * 审核经销商资料
     * @param $id
     * @param $status
     * @return array
     */
    public function status($id,$status){
        $re = ApplyRecord::find($id);
        $re->status = $status;
        if ($status==2){
            ClientUsers::where('users_id',$re['client_users_id'])->update(['identity_type'=>'经销商']);
        }else{
            $re->remarks = Input::get('remarks');
        }
        return $re->save()?['code'=>1,'message'=>'处理成功']:['code'=>0,'message'=>'处理失败'];
    }



    /**
     * 修改用户资料
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Request $request){
        if ($request->isMethod('post')){
            $model = new ClientUsers();
            if ($model->edit($request)){
                return redirect('/admin/client_users/index');
            }
            return redirect('/admin/client_users/edit?id='.$request->get('id'));
        }else{
            $data = ClientUsers::find($request->get('id'));
            return view('client_users.edit',['data'=>$data]);
        }

    }

}