<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/18
 * Time: 上午11:44
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Ptc extends Model
{
    protected $table = 'ptc';
    protected $time = '';

    protected $fillable = [

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
        $data = self::select(['id', 'client_users_name', 'shop_id', 'created_at','client_users_id','img','business_name'])
            ->where('created_at','>',$time[0])->where('created_at','<',$time[1])
            ->where(function ($query) use ($select,$keyword) {
                if ($select && $keyword) {
                    if (request('select')!=='1'){
                        $query->where($select, 'like', '%' . $keyword . '%');
                    }else{
                        $query->where('client_users_id', 'like', '%' . $keyword . '%')
                            ->orWhere('client_users_name', 'like', '%' . $keyword . '%')
                            ->orWhere('shop_id', 'like', '%' . $keyword . '%')
                            ->orWhere('business_name', 'like', '%' . $keyword . '%');
                    }
                }

            })
            ->orderBy('id', 'desc')
            ->paginate(config('language.pages'));
        //追加额外参数，例如搜索条件
        $appendData = $data->appends(array(
            'time'=>request('time')?request('time'):$this->time,
            'keyword'=>$keyword,
            'select' =>$select,
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


}