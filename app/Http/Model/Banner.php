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
        'show_position','sort'

    ];

    /**
     * 获取列表
     * @param $search
     * @return array
     */
    public function getList(){
        $data  = self::orderBy('id','asc')->get()->toArray();
        $homeImg = Remarks::where('type',1)->select(['id','remarks'])->first()->toArray();
        return ['datas'=>$data,'homeImg'=>$homeImg];
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

    public function edit($request){
       $data = $request->all();
        $file =  Input::file('img');
        $path = '/uploads';
        $rule =['jpg','png','gif'];
        if ($file){
            $img =  UploadsImg::upload_img($file,$path,$rule);
            $data['img'] = $img['path'];
        }
       $initTime  =explode(' - ',$data['time']);
       $data['show_start_time'] = $initTime[0];
       $data['show_end_time'] = $initTime[1];
       unset($data['_token']);
       unset($data['time']);
       return self::where(['id'=>$data['id']])->update($data);
    }

}