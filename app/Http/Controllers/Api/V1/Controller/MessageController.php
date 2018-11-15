<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/10
 * Time: 下午5:34
 */

namespace App\Http\Controllers\Api\V1\Controller;


use App\Http\Controllers\Api\Model\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MessageController extends BaseController
{
    /**
     * 短信接口
     * @return string
     */
    public function sendMsg(){
        $phone = Input::get('phone');
        if (!$phone || !is_numeric($phone)){
            return $this->jsonEncode(0,'手机号不正确');
        }
        $re = Message::send($phone);
        if ($re['code']){
            return $this->jsonEncode(1,'发送成功',['code'=>$re]);
        }else{
            return $this->jsonEncode(0,'验证码发送频繁,请稍后再试!');
        }

    }

    /**
     * 验证短信
     * @return string
     */
    public function check(Request $request){
        $phone  = $request->get('phone');
        $code  = $request->get('code');
        if ($phone && $code){
            $re =  Message::msgCheck($phone,$code);
            if ($re) {
                return $this->jsonEncode(1, '验证码正确');
            }
        }
        return $this->jsonEncode(0,'验证失败');
    }

    /**
     * 接口连通
     * @return string
     */
    public function sendTest(){
        return $this->jsonEncode(1,'接口请求成功');

    }

}