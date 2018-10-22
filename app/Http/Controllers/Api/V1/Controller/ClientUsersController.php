<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/12
 * Time: 上午10:20
 */

namespace App\Http\Controllers\Api\V1\Controller;

use App\Http\Controllers\Api\Model\ClientUsers;
use App\Http\Controllers\Api\Model\ClientUsersCollection;
use App\Http\Controllers\Api\Model\Ptc;
use App\Http\Model\ApplyRecord;
use App\Http\Model\Business;
use App\Http\Model\BusinessImg;
use App\Http\Model\Common;
use App\Http\Model\Coordinate;
use App\Http\Model\GeoTransUtil;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Psy\Exception\RuntimeException;
use Psy\Util\Json;


class ClientUsersController extends BaseController
{

    use Helpers;
    /*获取用户信息*/
    public function index(Request $request)
    {
        if ($request->method() == 'POST'){
             $id = ClientUsers::getUsers(['id'])['id'];
             $data = [
                'name'=>$request->get('name'),
                'sex'=>$request->get('sex'),
                'birthday'=>$request->get('birthday')
             ];
             $re =ClientUsers::where('id',$id)->update($data);
             return $re?$this->jsonEncode(1,'编辑成功'):$this->jsonEncode(0,'编辑失败');
        }else{
            $data = ClientUsers::getUsers(['users_id','name','sex','phone','headimgurl','birthday','identity_type']);
            $data['headimgurl']= config('language.url').$data['headimgurl'];
            $is_distributor =  ApplyRecord::where('client_users_id',$data['users_id'])->where('status',2)->select(['id'])->first();
            $data['is_distributor'] = $is_distributor?true:false;
            $is_distributor =  ApplyRecord::where('client_users_id',$data['users_id'])->whereIn('status',[1,2])->select(['id'])->first();
            $data['is_apply'] = $is_distributor?false:true;
            $data['apply_status'] =0;
            $data['remarks'] ='';
            $apply_status = ApplyRecord::where('client_users_id',$data['users_id'])->orderBy('id','desc')->select(['status','remarks'])->first();
            if ($apply_status){
                $data['apply_status'] = $apply_status['status'];
                $data['remarks'] = $apply_status['remarks'];
            }
            return $this->jsonEncode(1,'成功',$data);
        }

    }


    /**
     * 获取我收藏的商家列表
     * @return string
     */
    public function getCollection(){
        $users = ClientUsers::getUsers(['id']);
        $collection = ClientUsersCollection::where('client_users_id',$users['id'])->select(['business_id'])->get()->toArray();
        $data = [];
        if ($collection){
            $business_ids =  Common::map($collection,'business_id','business_id');
            $data = Business::whereIn('id',$business_ids)
                ->select(['id', 'name','category_id','shop_img','intro','sales_type','shop_id','browsing_num'])
                ->orderBy('id', 'desc')
                ->paginate(config('language.api_pages'))->toArray();
            if($data){
                $url =config('language.url');
                //获取商家详细页面的banner图片
                foreach ($data['data'] as &$value){
                    $value['shop_img'] =$url.$value['shop_img'];
                }
            }
        }
        return $this->jsonEncode(1,'成功',$data);

    }


    /**
     * 收藏商家  不存在添加,存在删除
     * @param Request $request
     * @return string
     */
    public function setCollection(Request $request){
        $business_id = $request->get('id');
        if (!$business_id){
            return $this->jsonEncode(0,'商家不存在');
        }
        $users = ClientUsers::getUsers(['id']);
        $row= ClientUsersCollection::where('client_users_id',$users['id'])
            ->where('business_id',$business_id)
            ->first();
        if ($row){
            $row->delete();
            return $this->jsonEncode(1,'取消成功',false);
        }else{
            ClientUsersCollection::create([
                'client_users_id'=>$users['id'],
                'business_id' => $business_id
            ]);
            return $this->jsonEncode(1,'收藏成功',true);
        }
    }


    /**
     * 批量删除我收藏的商家
     * @param Request $request
     * @return string
     */
    public function deleteCollection(Request $request){
        $ids = $request->get('ids');
        if (!$ids || !is_array($ids)){
            return $this->jsonEncode(0,'请传商家ID数组');
        }
        $users = ClientUsers::getUsers(['id']);
        ClientUsersCollection::whereIn('business_id',$ids)->where('client_users_id',$users['id'])->select(['business_id'])->delete();
        return $this->jsonEncode(1,'成功');
    }

    /**
     * 根据经纬度打卡
     * @param Request $request
     * @return string
     */
    public function ptc(Request $request){
        $users = ClientUsers::getUsers(['users_id','name']);
        if ($request->method() =='POST'){
            $data =Business::where('id',$request->get('id'))->select(['id','name','main_points_x','main_points_y'])->first();
            $main_points  = $request->get('main_points');
            if (!$data || !$main_points){
                return $this->jsonEncode(0,'参数不正确');
            }
            $re = Ptc::where('client_users_id',$users['users_id'])->where('date',date('Y-m'))->where('day',date('d'))->select(['id'])->first();
            if ($re){
                //TODO 每天仅限一次打卡,测试暂时屏蔽
                //return $this->jsonEncode(0,'今日已经打卡');
            }
            //TODO 根据 用户的经纬度和商家经纬度进行对比,在误差范围内打卡
            if (!Common::distance_calculation($main_points,$data['main_points_x'],$data['main_points_y'])){
                return $this->jsonEncode(0,'打卡失败,不在打卡范围');
            }
            $re = Ptc::create([
                'day'=>date('d'),
                'client_users_id'=>$users['users_id'],
                'date'=>date('Y-m'),
                'shop_id'=>$data['id'],
                'business_name'=>$data['name'],
                'client_users_name'=>$users['name'],
            ]);
            return $this->jsonEncode(1,'打卡成功',['id'=>$re['id']]);
        }else {
            $time =  date('Y-m');
            $reqDate =  $request->get('date');
            if($reqDate){
                $time  = $reqDate;
            }
            $data =  Ptc::where('client_users_id',$users['users_id'])->where('date',$time)->get()->toArray();
            $new_data = Common::map($data,'day','day');
            return $this->jsonEncode(1,'成功',$new_data);
        }
    }


    /**
     * 打卡后的资料上传
     * @param Request $request
     * @return string
     */
    public function ptcData(Request $request){
        $ptcData = json_decode($_REQUEST['data'],true);
        $str1 =str_replace("\"{'id':","",$ptcData['qrData']);
        $id=str_replace("}\"","",$str1);
        $users = ClientUsers::getUsers(['users_id','name']);
        $data =Business::where('id',$id)->select(['id','name','main_points_x','main_points_y'])->first();
        if (!$data){
            return $this->jsonEncode(0,'商家不存在');
        }
        $re = Ptc::where('client_users_id',$users['users_id'])->where('date',date('Y-m'))->where('day',date('d'))->select(['id'])->first();
        if ($re){
            //TODO 每天仅限一次打卡,测试暂时屏蔽
            //return $this->jsonEncode(0,'今日已经打卡');
        }
        $from = new Coordinate($ptcData['latitude'],$ptcData['longitude']);
        $ret = GeoTransUtil::gcjTObd($from);
        //TODO 根据 用户的经纬度和商家经纬度进行对比,在误差范围内打卡
        if (!Common::distance_calculation($ret->x,$ret->y,$data['main_points_x'],$data['main_points_y'])){
            return $this->jsonEncode(0,'打卡失败,不在打卡范围');
        }
        $rePtc = Ptc::create([
            'day'=>date('d'),
            'client_users_id'=>$users['users_id'],
            'date'=>date('Y-m'),
            'shop_id'=>$data['id'],
            'business_name'=>$data['name'],
            'position'=>$ptcData['address'],
            'img'=>Common::base64_image_content($ptcData['imgBase64']),
        ]);
        if ($rePtc){
            return $this->jsonEncode(1,'打卡成功',['id'=>$re['id']]);
        }
        return $this->jsonEncode(0,'处理失败');

    }



    /**business_name
     * 图片上传
     * @return string
     */
    public function uploadImg(Request $request){
        $file =  Input::file('img');
        if ($file){
            $business_license_img =  ClientUsers::uploadFile($file);
            if ($business_license_img){
                return $this->jsonEncode(1,'上传成功',$business_license_img);
            }
            return $this->jsonEncode(0,'上传失败');

        }
        return $this->jsonEncode(0,'请选择文件');
    }


    /**
     * 上传头像
     * @return string
     */
    public function uploadHeadimgurl(){
        $file =  Input::file('headimgurl');
        if ($file){
            $headimgurl =  ClientUsers::uploadFile($file);
            if ($headimgurl){
                $id = ClientUsers::getUsers(['id'])['id'];
                if( ClientUsers::where('id',$id)->update(['headimgurl'=>$headimgurl])){
                    return $this->jsonEncode(1,'成功',['headimgurl'=>config('language.url').$headimgurl]);
                }
                return $this->jsonEncode(0,'更新失败');
            }
        }
        return $this->jsonEncode(0,'请上传头像文件');
    }

}