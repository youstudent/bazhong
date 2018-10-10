<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Business;
use App\Http\Model\BusinessArea;
use App\Http\Model\BusinessImg;
use App\Http\Model\BusinessName;
use App\Http\model\Category;
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
            $category =Category::select(['id','category_name'])->get()->toArray();
            return view('business.create',['category'=>$category]);
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
            $category =Category::select(['id','category_name'])->get()->toArray();
            $img = BusinessImg::where('business_id',$data['id'])->select(['img','id'])->get()->toArray();
            return view('business.edit',['data'=>$data,'category'=>$category,'img'=>$img]);
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
        $data  = Category::get()->toArray();
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
        return view('business.option',['areas'=>$areas,'names'=>$names]);
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
        }else {
            BusinessName::create([
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
          if ($request->get('type')==1){
             BusinessArea::where('id',$id)->update(['area'=>$request->get('value')]);
          }else {
             BusinessName::where('id',$id)->update(['name'=>$request->get('value')]);
          }
          return ['code'=>1,'message'=>'更新成功'];

    }
}
