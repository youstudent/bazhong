<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/10
 * Time: 下午3:32
 */

namespace App\Http\Controllers\Api\V1\Controller;



use App\Http\Controllers\Api\Model\ClientUsers;
use App\Http\Controllers\Api\Model\ClientUsersCollection;
use App\Http\Model\Activity;
use App\Http\Model\Business;
use App\Http\Model\BusinessImg;
use App\Http\model\Category;
use App\Http\Model\Common;
use App\Http\Model\HotSearch;
use function foo\func;
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
        $model =new Business();
        $model->updates();
        $category_id = Input::get('category_id');
        $son_category_id = Input::get('son_category_id');
        $search = Input::get('name');
        $sortKey = Input::get('browsing_num');
        $a = 'browsing_num';
        $b = 'browsing_num';
        if ($sortKey!=='true'){
            $a  = 'sort_a';
            $b  = 'sort_b';
        }
        $data = Business::select(['business.id', 'name','category_id','shop_img','sort_a','sort_b','intro','sales_type','browsing_num','shop_id','son_category_id'])->join('category', 'business.category_id', '=', 'category.id')->join('category as son_category', 'business.son_category_id', '=', 'son_category.id')
            ->where(function ($query) use ($category_id,$search,$son_category_id,$sortKey) {
                if ($category_id) {
                    $query->where('category_id',  $category_id);
                }
                if ($son_category_id){
                    $query->where('son_category_id',  $son_category_id);
                }
                if ($search){
                    $query->where('name', 'like', '%' . $search . '%')->
                     orWhere('category.category_name', 'like', '%' . $search . '%')->
                     orWhere('son_category.category_name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy($a,'desc')->orderBy($b,'desc')
            ->paginate(config('language.api_pages'))->toArray();
        //获取商家详细页面的banner图片
        $url = config('language.url');
        foreach ($data['data'] as &$value){
            $value['shop_img'] = $url.$value['shop_img'];
        }
        return $this->jsonEncode(1,'ok',$data);
    }


    /**
     * 分类主分类
     * @return string
     */
    public function getCategory(){
        $data = Category::all()->toArray();
        $datas =  Common::map($data,'id','category_name');
        return $this->jsonEncode(1,'分类ID',$datas);
    }

    /**
     * 分类子分类
     * @return string
     */
    public function getSonCategory(Request $request){
        $category_id = $request->get('category_id');
        $data = Category::where('pid','!=',0)->get()->toArray();
        if ($category_id){
          $data = Category::where('pid',$category_id)->get()->toArray();
        }
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
            $data = Activity::where('shop_id',$shop_id)->where('activity_end_date','>',date('Y-m-d H:i:s'))->where('status',2)->select(['theme','img','id'])->get()->toArray();
            $url = config('language.url');
            foreach ($data as &$value){
                $value['img'] = $url.$value['img'];
            }
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


    /**
     * 获取商家详情
     * @param Request $request
     * @return string
     */
    public function getDetails(Request $request){
        $users = ClientUsers::getUsers(['id']);
        $id = $request->get('id');
        $data= Business::where('id',$id)->select(['main_points_x','main_points_y','shop_img','name','category_id','sales_type','intro','phone','browsing_num','shop_position'])->first()->toArray();
        $url= config('language.url');
        $data['shop_img'] = $url.$data['shop_img'];
        $re =  BusinessImg::select(['img'])->where('business_id',$id)->get()->toArray();
        $data['banner_img']= [];
        if ($re){
            foreach ($re as &$value){
                $value['img'] = $url.$value['img'];
            }
        }
        if ($re){
            $data['banner_img'] =  $re;
        }
        $collection = ClientUsersCollection::where('client_users_id',$users['id'])->where('business_id',$id)->select(['business_id','client_users_id'])->get()->toArray();
        $data['is_collection'] = $collection?true:false;
        $data['main_points'] = $data['main_points_y'].','.$data['main_points_x'];
        Business::where('id',$id)->increment('browsing_num');
        return $this->jsonEncode(1,'成功',$data);

    }

    /**
     * 获取首页分类详情
     * @return string
     */
    public function getCategoryList(){
       $data = Category::where('pid',0)->select(['category_name','id','icon'])->get()->toArray();
       $url = config('language.url');
       foreach ($data as &$value){
           $value['icon'] = $url.$value['icon'];
       }
       return $this->jsonEncode(1,'成功',$data);
    }

    /**
     * 获取活动详情
     * @param Request $request
     * @return string
     */
    public function activityDetail(Request $request){
        $id = $request->get('id');
        $data =Activity::where('id',$id)->select(['activity_time','activity_address','img','activity_date','content','theme'])->first()->toArray();
        $data['img'] =  config('language.url').$data['img'];
        return $this->jsonEncode(1,'成功',$data);

    }
}