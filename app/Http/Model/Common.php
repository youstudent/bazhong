<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/11
 * Time: 上午10:31
 */

namespace App\Http\Model;

use Illuminate\Http\Request;
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
    public static function distance_calculation($main_points1,$main_points_x2,$main_points_y2) {
        $main_points = explode(',',$main_points1);
        $lng1 = $main_points[1];
        $lat1 = $main_points[0];
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
        if ($s>100){
            return false;
        }
        return true;
    }

}