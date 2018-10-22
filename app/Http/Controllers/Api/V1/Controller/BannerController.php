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
use App\Http\Model\Remarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BannerController extends BaseController
{
    /**
     * banner广告图片
     * @return string
     */
    public function index(){
        $data = Banner::select(['id', 'img','show_position'])
            ->where('show_start_time','<',date('Y-m-d H:i:s'))
            ->where('show_end_time','>',date('Y-m-d H:i:s'))
            ->where('status',1)
            ->orderBy('sort', 'desc')
            ->get()->toArray();
        //拼接图片路径
        foreach ($data as &$value){
            $value['img'] =config('language.url').$value['img'];
        }
        return $this->jsonEncode(1,'ok',$data);
    }

    /**
     * 广告详情
     * @return string
     */
    public function detail(){
        $id = Input::get('id');
        if (!$id){
            return $this->jsonEncode(0,'失败','请传广告ID');
        }
        $data =  Banner::where('id',$id)->select(['id','content','is_sign_up','img'])->first()->toArray();
        $data['img'] = config('language.url').$data['img'];
        return $this->jsonEncode(1,'ok',$data);

    }


    /**
     * 广告报名
     * @param Request $request
     * @return string
     */
    public function signUp(Request $request){
        $data =  $request->all();
        if (!$data['phone'] || !$data['sex'] || !$data['name']){
            return $this->jsonEncode(0,'请填写完整资料');
        }
        $search = '/^0?1[3|4|5|6|7|8][0-9]\d{8}$/';
        if (!preg_match( $search, $data['phone']) ) {
            return $this->jsonEncode(0,'手机号不正确');
        }
        if ($data['id']){
            $banner = Banner::where('id',$data['id'])->select(['theme','id'])->first()->toArray();
            if ($banner){
                BannerSign_up::create([
                   'banner_id'=>$banner['id'],
                   'name'=>$data['name'],
                   'banner_theme'=>$banner['theme'],
                   'phone'=>$data['phone'],
                   'sex'=>$data['sex'],
                ]);
                return $this->jsonEncode(1,'报名成功');
            }
        }
        return $this->jsonEncode(0,'报名失败');
    }

    /**
     * 形象页面
     * @return string
     */
    public function homeImg(){
        $data  = Remarks::where('type',1)->select(['remarks'])->first()->toArray();
        return $this->jsonEncode(1,'形象图片',['img'=>config('language.url').$data['remarks']]);
    }

}