<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Model\Common;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页中心
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
       var_dump(Common::qrCode(5));
        $model = new User();
        $data= $model->getCount();
        return view('index.index',$data);
    }

}