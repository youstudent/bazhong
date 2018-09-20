<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/18
 * Time: 下午3:22
 */

namespace App\Http\Controllers\Agency\Model;


use App\UploadsImg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Activity extends Model
{
    protected $table = 'activity';

    protected $fillable = [
       'theme','content','activity_date','img','shop_id','activity_time','activity_address','activity_end_date'

    ];

    /**
     * 获取玩家列表
     * @param $search
     * @return array
     */
    public function getList($search){
        //初始化时间
        $time = $this->initTime($search);
        $keyword =  request('keyword')?request('keyword'):'';
        $select = request('select')?request('select'):'1';
        $status = request('status')?request('status'):'';
        $data = self::select(['id','created_at','theme','shop_id','activity_time','status'])
            ->where('created_at','>',$time[0])->where('created_at','<',$time[1])
            ->where(function ($query) use ($select,$keyword,$status) {
                if ($select && $keyword) {
                    if (request('select')!=='1'){
                        $query->where($select, 'like', '%' . $keyword . '%');
                    }else{
                        $query->where('shop_id', 'like', '%' . $keyword . '%')
                            ->orWhere('theme', 'like', '%' . $keyword . '%');
                    }
                }

                if ($status){
                    $query->where('status',$status);
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(config('language.pages'));
        //追加额外参数，例如搜索条件
        $appendData = $data->appends(array(
            'time'=>request('time')?request('time'):$this->time,
            'keyword'=>$keyword,
            'select' =>$select,
            'status' =>$status,
            'page' =>request('page')?request('page'):'1',
        ));
        return ['datas'=>$appendData,'time'=>$this->time];
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
     * 添加
     * @param $request
     * @return mixed
     */
    public function add($request){
        $file =  Input::file('img');
        $data =$request->all();
        $path = '/uploads';
        $rule =['jpg','png','gif'];
        if ($file){
            $img =  UploadsImg::upload_img($file,$path,$rule);
            $data['img'] = $img['path'];
        }
        $res = self::create([
            'shop_id'=>525011,
            'img'=>$data['img'],
            'theme'=>$data['theme'],
            'content'=>$data['content'],
            'activity_address'=>$data['activity_address'],
            'activity_time'=>$data['activity_time'],
            'activity_date'=>$data['activity_date'],
            'activity_end_date'=>explode(' - ',$data['activity_time'])[1]. explode(' - ',$data['activity_time'])[1]
        ]);
        if ($res){
            return true;
        }
        return false;
    }

}