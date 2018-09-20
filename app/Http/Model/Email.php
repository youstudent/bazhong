<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/11
 * Time: 下午4:04
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'email';
    protected $time = '';

    protected $fillable = [
        'title','content','business_id','category_id'
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
        $category_id = request('category_id')?request('category_id'):'';
        $data = self::select(['id', 'content', 'title', 'category_id', 'business_id','created_at'])
            ->where('created_at','>',$time[0])->where('created_at','<',$time[1])
            ->where(function ($query) use ($keyword,$category_id) {
                if ($keyword) {
                 $query->where('title', 'like', '%' . $keyword . '%');
                }
                if ($category_id){
                    $query->where('category_id',$category_id);
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(config('language.pages'));
        //追加额外参数，例如搜索条件
        $appendData = $data->appends(array(
            'time'=>request('time')?request('time'):$this->time,
            'keyword'=>$keyword,
            'category_id' =>$category_id,
            'page' =>request('page')?request('page'):'1',
        ));
        $Category= Category::select(['id','category_name'])->get()->toArray();
        return ['datas'=>$appendData,'time'=>$this->time,'category'=>$Category];
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
     * 分类表一对一
     * @return $this
     */
    public function category(){
        return $this->hasOne(Category::class,'id','category_id')->select(['category_name']);
    }



    /**
     * 分类表一对一
     * @return $this
     */
    public function business(){
        return $this->hasOne(Business::class,'id','business_id')->select(['name']);
    }


    /**
     * 添加
     * @param $request
     * @return mixed
     */
    public function add($request){
        $data =$request->all();
        $res = self::create($data);
        if ($res){
            return true;
        }
        return false;
    }

}