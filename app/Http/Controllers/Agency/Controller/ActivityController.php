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

    /**
     * 详情
     * @param $id
     * @return array
     */
    public function details($id){
        $data = Activity::where(['id'=>$id])->select(['content','theme','activity_address','img','remarks','activity_date'])->first()->toArray();
        if ($data){
            $html = "<table class='table table-hover table-bordered text-center table-striped'>
                        <tr>
                            <td>主题</td>
                            <td>{$data['theme']}</td>
                        </tr>
                        <tr>
                            <td>活动地址</td>
                            <td>{$data['activity_address']}</td>
                        </tr>
                        <tr>
                            <td>活动日期</td>
                            <td>{$data['activity_date']}</td>
                        </tr>
                        <tr>
                            <td>内容</td>
                            <td>{$data['content']}</td>
                        </tr>
                        <tr>
                            <td>活动图片</td>
                            <td><img style='width: 100px' src='/storage/{$data['img']}' alt=''></td>
                        </tr>
                        <tr>
                            <td>平台备注</td>
                            <td>{$data['remarks']}</td>
                        </tr>
                    </table>";
            return ['code'=>1,'message'=>'成功!','data'=>$html];
        }
        return ['code'=>0,'message'=>'数据不存在!'];
    }


    /**
     * 历史活动
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history(Request $request){
        $model = new Activity();
        $data = $model->getHistoryList($request->all());
        return view('agency.activity.history',$data);
    }


}