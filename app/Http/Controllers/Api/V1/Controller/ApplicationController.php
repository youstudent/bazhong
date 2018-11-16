<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/25
 * Time: 下午3:06
 */

namespace App\Http\Controllers\Api\V1\Controller;


use App\Http\Controllers\Api\Model\ClientUsers;
use App\Http\Model\ApplyRecord;
use App\Http\Model\BusinessArea;
use App\Http\Model\BusinessName;
use App\Http\Model\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ApplicationController extends BaseController
{

    /**
     * 申请成为经销商
     * @param Request $request
     * @return string
     */
    public function apply(Request $request){
        if ($request->method() =='POST'){
            if (!$request->get('business_area_id') || !$request->get('business_name') || !$request->get('identity') || !$request->get('business_license_img')){
                return $this->jsonEncode(0,'请填写完整资料!');
            }
            $data = $request->all();
            ApplyRecord::create([
               'name'=>$data['name'],
               'phone'=>$data['phone'],
               'email'=>isset($data['email'])?$data['email']:'',
               'identity'=>$data['identity'],
               'business_area_id'=>$data['business_area_id'],
               'business_name'=>$data['business_name'],
               'client_users_id' =>ClientUsers::getUsers(['users_id'])['users_id'],
               'business_license_img' =>isset($data['business_license_img'])?$data['business_license_img']:'',
            ]);
            return $this->jsonEncode(1,'申请成功');
        } else {
            $BusinessArea = Common::map(BusinessArea::all()->toArray(),'area','area');
            $BusinessName = Common::map(BusinessName::all()->toArray(),'name','name');
            $data['BusinessArea'] = $BusinessArea;
            $data['BusinessName'] = $BusinessName;
            return $this->jsonEncode(1,'成功',$data);
        }
    }

    /**
     * 获取被拒绝的记录
     * @return array
     */
    public function getHistoricalData(){
        $client_users_id  =   ClientUsers::getUsers(['users_id'])['users_id'];
        $data =   ApplyRecord::where('client_users_id',$client_users_id)->where('status',3)->orderBy('id','desc')->first();
        if ($data){
            unset($data['business_license_img']);
            return ['code'=>1,'message'=>'成功',$data];
        }
        return ['code'=>0,'message'=>'没有被拒记录'];

    }

    /**
     * 上传经销商图片
     * @return string
     */
    public function applyBusinessImg(){
        $file =  Input::file('business_license_img');
        if ($file){
            $business_license_img =  ClientUsers::uploadFile($file);
            if ($business_license_img){
                return $this->jsonEncode(1,'上传成功',$business_license_img);
            }
            return $this->jsonEncode(0,'上传失败');

        }
        return $this->jsonEncode(0,'请选择文件');
    }

}