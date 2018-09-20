<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/12
 * Time: 上午10:16
 */

namespace App\Http\Controllers\Api\V1\Controller;
use App\Http\Controllers\Api\Model\ClientUsers;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends BaseController
{
    use RegistersUsers;
    use Helpers;

    public function register(Request $request){

        $validator = $this->validator($request->all());
        if($validator->fails()){
            throw new StoreResourceFailedException("Validation Error", $validator->errors());
        }

        $user = $this->create($request->all());

        if($user->save()){

            $token = JWTAuth::fromUser($user);

            return $this->jsonEncode(1,'注册成功',['token'=>$token]);

            return $this->response->array([
                "token" => $token,
                "message" => "User created",
                "status_code" => 201
            ]);
        }else{
            return $this->jsonEncode(0,'注册失败');
            return $this->response->error("User Not Found...", 404);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required',
            'users_id' => 'required',
        ]);
    }

    protected function create(array $data)
    {
        return ClientUsers::create([
            'users_id' => $data['users_id'],
            'phone' => $data['phone'],
            //'password' => bcrypt($data['password']),
        ]);
    }

}