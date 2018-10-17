<?php

namespace App\Http\model;

use App\UploadsImg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\FamilyTree;

class Category extends Model
{
    protected $table = 'category';


    protected $fillable = [
      'pid','category_name'
    ];


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


    /**
     * @return array
     */
    public static function getCategories()
    {
        $categories = self::_getCategories();
        $familyTree = new \App\Http\Model\FamilyTree($categories);
        $array = $familyTree->getDescendants(0);
        return self::index($array, 'id');
    }


    protected static function _getCategories()
    {
        return self::orderBy('pid','asc')->get()->toArray();
    }




    public static function index($array, $key, $groups = [])
    {
        $result = [];
        $groups = (array) $groups;

        foreach ($array as $element) {
            $lastArray = &$result;

            foreach ($groups as $group) {
                $value = static::getValue($element, $group);
                if (!array_key_exists($value, $lastArray)) {
                    $lastArray[$value] = [];
                }
                $lastArray = &$lastArray[$value];
            }

            if ($key === null) {
                if (!empty($groups)) {
                    $lastArray[] = $element;
                }
            } else {
                $value = static::getValue($element, $key);
                if ($value !== null) {
                    if (is_float($value)) {
                        $value = self::floatToString($value);
                    }
                    $lastArray[$value] = $element;
                }
            }
            unset($lastArray);
        }

        return $result;
    }

    public static function getValue($array, $key, $default = null)
    {
        if ($key instanceof \Closure) {
            return $key($array, $default);
        }

        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                $array = static::getValue($array, $keyPart);
            }
            $key = $lastKey;
        }

        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            return $array[$key];
        }

        if (($pos = strrpos($key, '.')) !== false) {
            $array = static::getValue($array, substr($key, 0, $pos), $default);
            $key = substr($key, $pos + 1);
        }

        if (is_object($array)) {
            // this is expected to fail if the property does not exist, or __get() is not implemented
            // it is not reliably possible to check whether a property is accessible beforehand
            return $array->$key;
        } elseif (is_array($array)) {
            return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
        }

        return $default;
    }

    public static function floatToString($number)
    {
        // . and , are the only decimal separators known in ICU data,
        // so its safe to call str_replace here
        return str_replace(',', '.', (string) $number);
    }


    /**
     * 获取一级分类
     * @return array
     */
    public static function getPentId(){
        $data = self::where('pid',0)->select(['id'])->get()->toArray();
        $new_data = Common::map($data,'id','id');
        return $new_data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getPent($id){
       $pid =  self::where('id',$id)->select(['pid'])->first()['pid'];
       return $pid;
    }

}
