<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/11
 * Time: 上午10:31
 */

namespace App\Http\Model;

use Illuminate\Http\Request;
use Psy\Exception\RuntimeException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Common
{
    //格式化数组
    public static function map($array, $from, $to, $group = null)
    {
        $result = [];
        foreach ($array as $element) {
            $key = static::getValue($element, $from);
            $value = static::getValue($element, $to);
            if ($group !== null) {
                $result[static::getValue($element, $group)][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }


    protected static function getValue($array, $key, $default = null)
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

        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array)) ) {
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
        } else {
            return $default;
        }
    }

    /**
     * 上传二维码图片
     * @param $id
     * @return string
     */
    public static function qrCode($id){
        $fileNamePath ='/qrcodes/'. date('Y-m-d').rand(10000,99999).'.png';
        QrCode::format('png')->size(200)->margin(1)->merge('/public/qrcodes/1.png',.15)->generate("{'id':$id}",public_path($fileNamePath));
        return $fileNamePath;
    }


    /**
     * 客户端经纬度和商家经纬度距离计算
     * @param $main_points1
     * @param $main_points_x2
     * @param $main_points_y2
     */
    public static function distance_calculation($main_points1,$main_points2,$main_points_x2,$main_points_y2) {
        $lng1 = $main_points2;
        $lat1 = $main_points1;
        $lng2 = $main_points_x2;
        $lat2 = $main_points_y2;
        // 将角度转为狐度
        $radLat1 = deg2rad($lat1); //deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;
        file_put_contents(__DIR__.'pac.txt',json_encode(['main_points1'=>$main_points1,'main_points2'=>$main_points2,'main_points_x2'=>$main_points_x2,'main_points_y2'=>$main_points_y2,'mi'=>$s]).PHP_EOL,FILE_APPEND);
        if ($s>100){
            return false;
        }
        return true;
    }

    public static function img_upload($base64_img){
        $base64_string= explode(',', $base64_img); //截取data:image/png;base64, 这个逗号后的字符
        $data= base64_decode($base64_string[1]);
        var_dump($data);exit;
        $base64_img = trim($base64_img);

        $up_dir = './upload/';//存放在当前目录的upload文件夹下

        if(!file_exists($up_dir)){
            mkdir($up_dir,0777);
        }

        if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){

            $type = $result[2];

            if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){

                $new_file = $up_dir.date('YmdHis').'.'.$type;
                if(file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_img)))){

                    $img_path = str_replace('../../..', '', $new_file);

                    return array('code' => 1, 'msg' => "图片上传成功", 'url' => $img_path);

                }

                return array('code' => 2, 'msg' => "图片上传失败");

            }

            //文件类型错误

            return array('code' => 4, 'msg' => "文件类型错误");

        }

        //文件错误

        return array('code' => 3, 'msg' => "文件错误");

    }

    public static function base64_image_content($imgBase64){
        $imgBase64 = str_replace(" ", "+", $imgBase64);
        //保存base64字符串为图片
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $imgBase64, $result)){
            $type = $result[2];
            $time = time();
            $new_file = "storage/uploads/{$time}.{$type}";
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $imgBase64)))) {
               return '/'.$new_file;
            }
        }
    }

}