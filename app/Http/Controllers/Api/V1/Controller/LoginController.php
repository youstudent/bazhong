<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/12
 * Time: 上午10:12
 */

namespace App\Http\Controllers\Api\V1\Controller;
use App\Http\Controllers\Api\Model\ClientUsers;
use App\Http\Controllers\Api\Model\Message;
use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends BaseController
{
    use AuthenticatesUsers;
    use Helpers;

    /**
     * 手机号登录注册,微信登录注册
     * @param Request $request
     * @return string
     */
    public function login(Request $request){
        $phone =  $request->get('phone');
        $code =  $request->get('code');
        //手机号码登录
        if ($phone && $code){
            if (!Message::msgCheck($phone,$code)){
                return $this->jsonEncode(0,'验证码不正确');
            }
            $ClientUser = ClientUsers::where('phone', $request->phone)->first();
            if ($ClientUser){
                $ClientUser->updated_at = date('Y-m-d H:i:s');
                $ClientUser->save();
                $token = JWTAuth::fromUser($ClientUser);
                return $this->sendLoginResponse($request, $token);
            }
            $users = ClientUsers::create([
                'users_id'=>ClientUsers::createCode(),
                'phone' => $request->get('phone'),
            ]);
            if ($users){
                $token = JWTAuth::fromUser($users);
                return $this->sendLoginResponse($request, $token);
            }
                return $this->jsonEncode(0,'注册失败');
        //微信登录
        }else{
            $openid = $request->get('openid');
            if ($openid){
                $ClientUser = ClientUsers::where('openid',$request->openid)->first();
                if ($ClientUser){
                    $ClientUser->updated_at = date('Y-m-d H:i:s');
                    $ClientUser->save();
                    $token = JWTAuth::fromUser($ClientUser);
                    return $this->sendLoginResponse($request, $token);
                }else {
                    $users = ClientUsers::create([
                        'users_id'=>ClientUsers::createCode(),
                        'openid' => $request->get('openid'),
                        'sex' => $request->get('sex'),
                        'name' => $request->get('name'),
                        'headimgurl' => $request->get('headimgurl'),
                    ]);
                    if ($users){
                        $token = JWTAuth::fromUser($users);
                        return $this->sendLoginResponse($request, $token);
                    }
                        return $this->jsonEncode(0,'注册失败');
                }
            }
            return $this->jsonEncode(0,'微信参数不正确');
        }

    }

    /**
     * 登录成功响应
     * @param Request $request
     * @param $token
     * @return string
     */
    public function sendLoginResponse(Request $request, $token){
        $this->clearLoginAttempts($request);

        return $this->authenticated($token);
    }

    public function authenticated($token){
        return $this->jsonEncode(1,'登陆成功',['token'=>$token]);
    }

    /**
     * 退出登录
     */
    public function logout(){
        $this->guard()->logout();
    }
}