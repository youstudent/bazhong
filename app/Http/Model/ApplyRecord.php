<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/25
 * Time: 下午3:27
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class ApplyRecord extends Model
{
    protected $table = 'apply_record';
    protected $time = '';
    protected $fillable = [
      'name','phone','email','identity','business_license_img','business_area_id','business_name','client_users_id'
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
        $data = self
            ::where('created_at','>',$time[0])->where('created_at','<',$time[1])
            ->where(function ($query) use ($select,$keyword,$status) {
                if ($select && $keyword) {
                    if (request('select')!=='1'){
                        $query->where($select, 'like', '%' . $keyword . '%');
                    }else{
                        $query->where('client_users_id', 'like', '%' . $keyword . '%')
                            ->orWhere('name', 'like', '%' . $keyword . '%');
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
//        $business_area =Common::map(BusinessArea::all()->toArray(),'id','area');
//        foreach ($data as &$value){
//            $value['business_area_id'] = $business_area[$value['business_area_id']];
//        }
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

}