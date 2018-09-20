<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/20
 * Time: 下午4:43
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use HuangYi\Rbac\Models\Role;
use Illuminate\Http\Request;

class RbacController extends Controller
{
    /**
     * 角色列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roleList(){
        $data = Role::all()->toArray();
        return view('role.index',['datas'=>$data]);
    }


    /**
     * 添加角色
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function roleAdd(Request $request){
        if ($request->method() =='POST'){
            $roleManager = new \HuangYi\Rbac\Managers\RoleManager();
            $roleManager->create([
                'name'=>'测试人员',
                'description'=>'这是描述',
                'created_at' =>date('Y-m-d H:i:s')
            ]);
            return redirect('/admin/role/roleList');
        }else {
            return view('role.add');
        }
    }


    /**
     * 添加权限
     */
    public function permissionAdd(){
        $permissionManager = new \HuangYi\Rbac\Managers\PermissionManager();
        $permission = $permissionManager->create([
            'name' => 'Create product',
            'slug' => 'product.create',
            'description' => 'Create a new product.',
        ]);

    }

    /**
     * 角色绑定权限
     */
    public function roleBindingPermission(){
        $roleManager = new \HuangYi\Rbac\Managers\RoleManager();
        $roleManager->attachPermissions(1);
    }

}