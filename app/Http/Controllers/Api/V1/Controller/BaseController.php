<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/3
 * Time: 下午5:27
 */

namespace App\Http\Controllers\Api\V1\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dingo\Api\Routing\Helpers;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,Helpers;

    /**
     *  统一json返回
     * @param $code
     * @param string $message
     * @param string $data
     * @return string
     */
    public function jsonEncode($code,$message='',$data=''){
        if (!is_numeric($code)){
            return '';
        }
        $data = [
           'code' => $code,
           'message' => $message,
           'time' => time(),
           'data' => $data,
        ];
        return $this->response->array($data);
    }

}