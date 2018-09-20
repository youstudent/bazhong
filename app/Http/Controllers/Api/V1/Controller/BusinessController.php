<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/10
 * Time: 下午3:32
 */

namespace App\Http\Controllers\Api\V1\Controller;



use App\Http\Model\Activity;
use App\Http\Model\Business;
use App\Http\Model\BusinessImg;
use App\Http\model\Category;
use App\Http\Model\Common;
use App\Http\Model\HotSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class BusinessController extends BaseController
{

    /**
     * 商家列表
     * @return string
     */
    public function index(){
        $category_id = Input::get('category_id');
        $search = Input::get('name');
        $sortKey = Input::get('browsing_num')?'browsing_num':'id';
        $data = Business::select(['id', 'name','category_id','shop_img','intro','sales_type','browsing_num','phone','shop_position','shop_id'])
            ->where(function ($query) use ($category_id,$search) {
                if ($category_id) {
                    $query->where('category_id',  $category_id);
                }
                if ($search){
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy($sortKey, 'desc')
            ->paginate(config('language.pages'))->toArray();
        //获取商家详细页面的banner图片
        foreach ($data['data'] as &$value){
            $value['banner_img'] = BusinessImg::select(['img'])->where('business_id',$value['id'])->get()->toArray();
        }
        return $this->jsonEncode(1,'ok',$data);
    }


    /**
     * 分类详情
     * @return string
     */
    public function getCategory(){
        $data = Category::all()->toArray();
        $datas =  Common::map($data,'id','category_name');
        return $this->jsonEncode(1,'分类ID',$datas);
    }


    /**
     * 指定商家的活动
     * @param Request $request
     * @return string
     */
    public function activityList(Request $request){
        $shop_id = $request->get('shop_id');
        if ($shop_id){
            $data = Activity::where('shop_id',$shop_id)->where('status',2)->select(['theme','activity_time','activity_address','img','activity_date'])->get()->toArray();
            return  $this->jsonEncode(1,'成功',$data);
        }
        return $this->jsonEncode(0,'请传商家ID  shop_id');
    }


    /**
     * 热门搜索
     * @return string
     */
    public function hotSearch(){
        $data = HotSearch::select(['name','id'])->get()->toArray();
        $new_data = Common::map($data,'id','name');
        return $this->jsonEncode(1,'成功',$new_data);
    }




}