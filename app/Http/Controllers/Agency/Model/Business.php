<?php

namespace App\Http\Controllers\Agency\Model;
use App\Http\Model\Email;
use App\UploadsImg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/13
 * Time: 下午4:24
 */
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Business extends Authenticatable
{
    use Notifiable;
    protected $table = 'business';

    protected $time = '';
    protected $fillable = [
        'phone','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 统计首页中心的数量
     * @return array
     */
    public function getCount(){
        $emailCount = Email::select(['id'])->where('category_id',1)->orWhere('business_id',2)->count();
        $activityCount = Activity::where('shop_id',525011)->select(['id'])->count();
        $activityIngCount = 10;
        $activityRefuseCount = Activity::where('shop_id',525011)->where('status',3)->select(['id'])->count();
        $data = Business::select(['id','name','intro','shop_img','shop_position'])->where('id',53)->first()->toArray();
        return ['emailCount'=>$emailCount,'activityCount'=>$activityCount,'activityIngCount'=>$activityIngCount,'activityRefuseCount'=>$activityRefuseCount,'data'=>$data];
    }


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
        $data = Email::select(['id','created_at','title','content'])
            ->where('created_at','>',$time[0])->where('created_at','<',$time[1])
            ->where(function ($query) use ($select,$keyword) {
                $query->where('business_id',51)->orWhere('category_id',2);
                if ($select && $keyword) {
                    if (request('select')!=='1'){
                        $query->where($select, 'like', '%' . $keyword . '%');
                    }else{
                        $query->where('title', 'like', '%' . $keyword . '%');
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


    public function add($request){
        $file =  Input::file('shop_img');
        $path = '/uploads';
        $rule =['jpg','png','gif'];
        $data= $request->all();
        if ($file){
            $img =  UploadsImg::upload_img($file,$path,$rule);
            $data['shop_img'] = $img['path'];
        }
        unset($data['_token']);
        self::where('id',$data['id'])->update($data);
    }


    public static function getEmailCount(){
        $emailCount = Email::select(['id'])->where('category_id',1)->orWhere('business_id',2)->count();
        return $emailCount;
    }


    public static function getEmail(){
        $email = Email::where('category_id',1)->orWhere('business_id',2)->get()->toArray();
        return $email;
    }
}