<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Business;
use App\Http\Model\BusinessArea;
use App\Http\Model\BusinessImg;
use App\Http\Model\BusinessName;
use App\Http\model\Category;
use App\Http\Model\Coordinate;
use App\Http\Model\FamilyTree;
use App\Http\Model\GeoTransUtil;
use App\Http\Model\HotSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BusinessController extends Controller
{

    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
         $from = new Coordinate(30.546586,104.068007);
         $ret = GeoTransUtil::gcjTObd($from);
         $model = new Business();
         $data = $model->getList($request->all());
        return view('business.index',$data);
    }


    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request){
        if ($request->isMethod('post')){
            $model = new Business();
            if ($model->add($request)){
                return redirect('admin/business/index');
            }
            return redirect('admin/business/create');

        }else{
            $category = FamilyTree::getCategoriesName();
            //$category =Category::select(['id','category_name'])->get()->toArray();
            $pent_data = Category::getPentId();
            return view('business.create',['category'=>$category,'pent_data'=>$pent_data]);
        }
    }

    /**
     * 修改
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Request $request){
        if ($request->isMethod('post')){
            $model = new Business();
            if ($model->edit($request)){
               return redirect('admin/business/index');
            }
            return redirect('admin/business/edit?id='.$request->get('id'));
        }else{
            $data = Business::find($request->get('id'));
            //$category =Category::select(['id','category_name'])->get()->toArray();
            $category = FamilyTree::getCategoriesName();
            $pent_data = Category::getPentId();
            $img = BusinessImg::where('business_id',$data['id'])->select(['img','id'])->get()->toArray();
            return view('business.edit',['data'=>$data,'category'=>$category,'img'=>$img,'pent_data'=>$pent_data]);
        }

    }

    /**
     * 删除
     * @param $id
     * @return array
     */
    public function delete($id){
        if ($id){
         Business::destroy($id);
         BusinessImg::where('business_id',$id)->delete();
            return ['code'=>1,'message'=>'删除成功'];
        }
           return ['code'=>0,'message'=>'数据不存在!'];
    }


    /**
     * 删除logo图片
     * @return int
     */
    public function del(){
        BusinessImg::destroy(Input::get('key'));
        return 1;
    }


    /**
     * 分类管理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryList(){
        $data = Category::getCategories();
        return view('business.categoryList',['datas'=>$data]);
    }


    /**
     * 修改分类图标
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function categoryEdit(Request $request){
        if ($request->isMethod('post')){
            $model = new Category();
            if ($model->edit($request)){
                return redirect('/admin/business/categoryList');
            }
            return redirect('/admin/business/categoryEdit?id='.$request->get('id'));
        }else{
            $data = Category::find($request->get('id'));
            return view('business.categoryEdit',['data'=>$data]);
        }

    }

    /**
     * 创建分类
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function categoryCreate(Request $request){
          if ($request->isMethod('post')){
              $data = $request->all();
              Category::create([
                 'pid'=>$data['category_id'],
                 'category_name'=>$data['category_name'],
              ]);
              return redirect('/admin/business/categoryList');
          }else {
              $category = Category::get()->toArray();
              return view('business.categoryCreate',['category'=>$category,'category_id'=>$request->get('id')]);
          }
    }

    /**
     * 修改分类
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function categorySonEdit(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            Category::where(['id'=>$data['id']])->update([
                'pid'=>$data['category_id'],
                'category_name'=>$data['category_name'],
            ]);
            return redirect('/admin/business/categoryList');
        }else {
            $data = Category::find($request->get('id'));
            $category = Category::where('pid',0)->get()->toArray();
            return view('business.categorySonEdit',['category'=>$category,'data'=>$data]);
        }
    }

    /**
     * 删除二级分类
     * @param $id
     * @return array
     */
    public function categoryDelete($id){
        if ($id){
            if (Business::where('son_category_id',$id)->select(['id'])->first()){
                return ['code'=>0,'message'=>'该子分类有商家不能删除'];
            }
            Category::destroy($id);
            return ['code'=>1,'message'=>'删除成功'];
        }
        return ['code'=>0,'message'=>'数据不存在!'];
    }


    /**
     * 通过拒绝
     * @param $id
     * @return array
     */
    public function status($id,$status){
        $remarks = Input::get('remarks');
        $re = Business::find($id);
        $re->status =$status;
        $re->remarks =$remarks;
        if ($re->save()){
            return ['code'=>1,'message'=>'成功!'];
        }
        return ['code'=>0,'message'=>'数据不存在!'];
    }


    /**
     * 详情
     * @param $id
     * @return array
     */
    public function details($id){
        $data = Activity::where(['id'=>$id])->select(['content','theme','activity_address','img','remarks','activity_date'])->first()->toArray();
        if ($data){
            $html = "<table class='table table-hover table-bordered text-center table-striped'>
                        <tr>
                            <td>主题</td>
                            <td>{$data['theme']}</td>
                        </tr>
                        <tr>
                            <td>活动地址</td>
                            <td>{$data['activity_address']}</td>
                        </tr>
                        <tr>
                            <td>活动日期</td>
                            <td>{$data['activity_date']}</td>
                        </tr>
                        <tr>
                            <td>内容</td>
                            <td>{$data['content']}</td>
                        </tr>
                        <tr>
                            <td>活动图片</td>
                            <td><img style='width: 100px' src='/storage/{$data['img']}' alt=''></td>
                        </tr>
                        <tr>
                            <td>平台备注</td>
                            <td>{$data['remarks']}</td>
                        </tr>
                    </table>";
            return ['code'=>1,'message'=>'成功!','data'=>$html];
        }
        return ['code'=>0,'message'=>'数据不存在!'];
    }


    /**
     * 参数选项配置
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function option(){
        $areas = BusinessArea::select(['id','area'])->get()->toArray();
        $names = BusinessName::select(['id','name'])->get()->toArray();
        $HotSearch = HotSearch::select(['id','name'])->get()->toArray();
        return view('business.option',['areas'=>$areas,'names'=>$names,'HotSearch'=>$HotSearch]);
    }

    /**
     * 删除
     * @param $id
     * @return array
     */
    public function areaDelete($id){
        if ($id){
            BusinessArea::destroy($id);
            return ['code'=>1,'message'=>'删除成功'];
        }
        return ['code'=>0,'message'=>'数据不存在!'];
    }


    /**
     * 删除
     * @param $id
     * @return array
     */
    public function nameDelete($id){
        if ($id){
            BusinessName::destroy($id);
            return ['code'=>1,'message'=>'删除成功'];
        }
        return ['code'=>0,'message'=>'数据不存在!'];
    }

    /**
     * 删除
     * @param $id
     * @return array
     */
    public function hotDelete($id){
        if ($id){
            HotSearch::destroy($id);
            return ['code'=>1,'message'=>'删除成功'];
        }
        return ['code'=>0,'message'=>'数据不存在!'];
    }


    /**
     * 添加区域
     * @param Request $request
     * @param $type
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createAreaName(Request $request,$type){
        if ($type==1){
            BusinessArea::create([
               'area'=>$request->get('area')
            ]);
        }else if ($type==2) {
            BusinessName::create([
                'name'=>$request->get('name')
            ]);
        }else {
            HotSearch::create([
                'name'=>$request->get('name')
            ]);
        }
        return redirect('/admin/business/option');
    }

    /**
     * 更新区域
     * @param Request $request
     * @param $id
     * @return array
     */
    public function editOption(Request $request,$id){
          $type =$request->get('type');
          if ($type==1){
             BusinessArea::where('id',$id)->update(['area'=>$request->get('value')]);
          }else if ($type==2) {
             BusinessName::where('id',$id)->update(['name'=>$request->get('value')]);
          }else{
             HotSearch::where('id',$id)->update(['name'=>$request->get('value')]);
          }
          return ['code'=>1,'message'=>'更新成功'];
    }
}
