<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/11
 * Time: 下午2:35
 */

namespace App\Http\Controllers\Api\V1\Controller;


use App\Http\Model\Banner;
use App\Http\Model\BannerSign_up;
use Illuminate\Http\Request;

class BannerController extends BaseController
{
    /**
     * banner广告图片
     * @return string
     */
    public function index(){
        $data = Banner::select(['id', 'img','show_position','img','content','is_sign_up'])
            ->where('show_start_time','<',date('Y-m-d H:i:s'))
            ->where('show_end_time','>',date('Y-m-d H:i:s'))
            ->where('status',1)
            ->orderBy('sort', 'desc')
            ->get()->toArray();
        return $this->jsonEncode(1,'ok',$data);
    }


    /**
     * 广告报名
     * @param Request $request
     * @return string
     */
    public function signUp(Request $request){
        $banner_id = $request->get('banner_id');
        if ($banner_id){
            $banner = Banner::where('id',$banner_id)->select(['theme','id'])->first()->toArray();
            if ($banner){
                BannerSign_up::create([
                   'banner_id'=>$banner['id'],
                   'name'=>$request->get('name'),
                   'banner_theme'=>$banner['theme'],
                   'phone'=>$request->get('phone'),
                   'sex'=>$request->get('sex'),
                ]);
                return $this->jsonEncode(1,'报名成功');
            }
        }
        return $this->jsonEncode(0,'报名失败');
    }

}