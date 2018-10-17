<?php

namespace App\Http\Model;

use App\UploadsImg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Business extends Model
{
    protected $table = 'business';
    protected $time ='';

    //表单数据录入
    protected $fillable = [
     'phone','name','email','intro','shop_position','password','sales_type','category_id','shop_img','shop_id','main_points_x','main_points_y','remarks','code_img','son_category_id'
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
        $category_id = request('category_id')?request('category_id'):'';
        $data = self::select(['id', 'email', 'name', 'phone', 'created_at','category_id','shop_img','shop_id','browsing_num','status','code_img','son_category_id'])
            ->where('created_at','>',$time[0])->where('created_at','<',$time[1])
            ->where(function ($query) use ($select,$keyword,$category_id) {
                if ($select && $keyword) {
                    if (request('select')!=='1'){
                        $query->where($select, 'like', '%' . $keyword . '%');
                    }else{
                        $query->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('phone', 'like', '%' . $keyword . '%');
                    }
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
            'select' =>$select,
            'category_id' =>$category_id,
            'page' =>request('page')?request('page'):'1',
        ));
        $Category = Common::map(Category::select(['id','category_name'])->get()->toArray(),'id','category_name');
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
     * 添加
     * @param $request
     * @return mixed
     */
    public function add($request){
        $request->validate([
            'name' => 'required|max:255'
        ],['name.required'=>'店铺名不能为空']);

        $file =  Input::file('shop_img');
        $data =$request->all();
        $path = '/uploads';
        $rule =['jpg','png','gif','jpeg'];
        if ($file){
            $img =  UploadsImg::upload_img($file,$path,$rule);
            if (!$img){
                return redirect('admin/business/create');
            }
            $data['shop_img'] = $img['path'];
        }
        $data['password'] = Hash::make($data['password']);
        $data['shop_id'] = self::createCode();
        $data['category_id'] =Category::getPent($data['son_category_id']);
        $res = self::create($data);
        if ($res){
            $res->update(['code_img'=>Common::qrCode($res->id)]);
            $files = Input::file('files');
            if ($files){
                foreach ($files as $file){
                    $img =  UploadsImg::upload_img($file,$path,$rule);
                    BusinessImg::create([
                        'img'=>$img['path'],
                        'business_id'=>$res->id
                    ]);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 修改图片
     * @param $data
     * @param $request
     * @return bool
     */
    public function edit($request){
        $request->validate([
            'name' => 'required|max:255'
        ],['name.required'=>'店铺名不能为空','password.required'=>'密码不能为空']);
        $file =  Input::file('shop_img');
        $path = '/uploads';
        $rule =['jpg','png','gif','jpeg'];
        $data= $request->all();
        if ($file){
            $img =  UploadsImg::upload_img(Input::file('shop_img'),$path,$rule);
            $data['shop_img'] = $img['path'];
        }
        if ($data['password']){
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'];
        }
        unset($data['_token']);
        unset($data['files']);
        if (empty($data['shop_position'])){
            unset($data['main_points_x']);
            unset($data['main_points_y']);
            unset($data['shop_position']);
        }
        if (empty($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = Hash::make($data['password']);
        }
        $data['category_id'] =Category::getPent($data['son_category_id']);
        $res = self::where('id',$data['id'])->update($data);
        if ($res){
            $files = Input::file('files');
            if ($files){
                BusinessImg::where('business_id',$data['id'])->delete();
                foreach ($files as $file){
                    $img =  UploadsImg::upload_img($file,$path,$rule);
                    BusinessImg::create([
                        'img'=>$img['path'],
                        'business_id'=>$data['id']
                    ]);
                }
            }
            return true;
        }
        return false;
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
    public function sonCategory(){
        return $this->hasOne(Category::class,'id','son_category_id')->select(['category_name']);
    }

    /**
     * 创建一个无重复的推荐码
     * @return int
     */
    public static function createCode()
    {
        $shop_id = rand(100000,999999);
        $data = self::where(['shop_id'=>$shop_id])->first();
        if($data)
            return $shop_id = self::createCode();
        return $shop_id;
    }

}
