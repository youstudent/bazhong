<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/12
 * Time: 上午10:03
 */

namespace App\Http\Controllers\Api\Model;

use App\UploadsImg;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientUsers extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'client_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'name','users_id','openid','sex','headimgurl','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * 创建一个无重复的推荐码
     * @return int
     */
    public static function createCode()
    {
        $users_id = rand(100000,999999);
        $data = self::where(['users_id'=>$users_id])->first();
        if($data)
            return $users_id = self::createCode();
        return $users_id;
    }

    /**
     * 获取Tken认证的用户
     * @return mixed
     */
    public static function getUsers($select =[]){
        $data = ClientUsers::select($select)->find(JWTAuth::toUser(JWTAuth::getToken()));
        return $data;
    }


    /**
     * 上传玩家头像
     */
    public static function uploadFile($file){
        $path = '/uploads';
        $rule =['jpg','png','gif'];
        if ($file){
            $img =  UploadsImg::upload_img($file,$path,$rule);
            return $img['path'];
        }
        return '';

    }
}