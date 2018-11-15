<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/17
 * Time: 上午10:59
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Model\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{

    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $model = new Activity();
        $data = $model->getList($request->all());
        return view('activity.index',$data);
    }

    /**
     * 通过拒绝
     * @param $id
     * @return array
     */
    public function status($id){
           $remarks = Input::get('remarks');
           $re = Activity::find($id);
           if ($re){
               $re->status = 2;
               if ($remarks){
                   $re->status = 3;
                   $re->remarks = $remarks;
               }
               $re->save();
               return ['code'=>1,'message'=>'处理成功'];
           }
        return ['code'=>0,'message'=>'数据不存在!'];
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


}