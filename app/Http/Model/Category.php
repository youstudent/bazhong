<?php

namespace App\Http\model;

use App\UploadsImg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Category extends Model
{
    protected $table = 'category';


    /**
     * 修改分类的图标
     * @param $request
     * @return mixed
     */
    public function edit($request){
        $data = $request->all();
        $file =  Input::file('icon');
        $path = '/uploads';
        $rule =['jpg','png','gif'];
        if ($file){
            $img =  UploadsImg::upload_img($file,$path,$rule);
            $data['icon'] = $img['path'];
        }
        unset($data['_token']);
        return self::where(['id'=>$data['id']])->update($data);
    }
}
