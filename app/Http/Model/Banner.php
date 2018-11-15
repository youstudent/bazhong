<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/10
 * Time: 下午6:01
 */

namespace App\Http\Model;


use App\UploadsImg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Banner extends Model
{
    protected $time ='';

    protected $table = 'banner';


    protected $fillable = [
        'show_position','sort','business_id'

    ];

    /**
     * 获取列表
     * @param $search
     * @return array
     */
    public function getList(){
        $data  = self::orderBy('id','asc')->get()->toArray();
        $homeImg = Remarks::where('type',1)->select(['id','remarks'])->first()->toArray();
        foreach ($data as &$value){
            if ($value['business_id']){
                $re = Business::whereIn('id',json_decode($value['business_id']))->select(['name'])->get()->toArray();
                $value['business_id'] = implode(',',Common::map($re,'name','name'));
            }
        }
        $category = Common::map(Category::select(['id','category_name'])->get()->toArray(),'id','category_name');
        return ['datas'=>$data,'homeImg'=>$homeImg,'category'=>$category];
    }


    /**
     * 初始化时间
     * @param $search
     * @return array
     */
    public function initTime($search){
        if (isset($search['time'])){
            $this->time = $search['time'];
            return explode(' - ',$search['time']);
        }
        $times = config('language.start_time').' - '.date('Y-m-d H:i:s',strtotime('+1 day'));
        $this->time = $times;
        return explode(' - ',$times);
    }

    /**
     * 修改图片
     * @param $request
     * @return mixed
     */
    public function edit($request){
        $data = $request->all();
        if ($res = self::where('id',$data['id'])->select(['business_id'])->first()){
            Business::whereIn('id',json_decode($res->business_id))->update(['sort_a'=>null]);
        }
        Business::whereIn('id',$data['business'])->update(['sort_a'=>1]);
        $data['business_id']  = json_encode($data['business']);
        $file =  Input::file('img');
        $path = '/uploads';
        $rule =['jpg','png','gif','jpeg'];
        if ($file){
            $img =  UploadsImg::upload_img($file,$path,$rule);
            $data['img'] = $img['path'];
        }
       $initTime  =explode(' - ',$data['time']);
       $data['show_start_time'] = $initTime[0];
       $data['show_end_time'] = $initTime[1];
       unset($data['_token']);
       unset($data['time']);
       unset($data['business']);
       return self::where(['id'=>$data['id']])->update($data);
    }

}