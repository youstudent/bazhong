<?php
namespace App\Http\Controllers\Api\Model;
use Illuminate\Database\Eloquent\Model;
use Mrgoon\AliSms\AliSms;

/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/10
 * Time: 下午5:38
 */
class Message extends Model
{
    protected $table = 'message_send';

    protected $fillable = [
      'code','phone','status'
    ];

    /**
     * 发送短信
     * @param $phone
     * @return mixed
     */
    public static function send($phone){
        $code = rand(100000,999999);
        $aliSms = new AliSms();
        $response = $aliSms->sendSms($phone, 'SMS_144852511',['code'=> $code]);
        if ($response->Code =='OK'){
            self::create([
                'code'=>$code,
                'phone'=>$phone
            ]);
            return ['code'=>$code,'message'=>$response->Message];
        }
        return ['code'=>'','message'=>$response->Message];

    }

    /**
     * 验证短信
     * @param $phone
     * @param $code
     * @return bool
     */
    public static function msgCheck($phone,$code){
       $data =  self::where('phone',$phone)->orderBy('id','desc')->where('created_at','>=',date('Y-m-d H:i:s',time()-1800))->where('code',$code)->where('status','=',0)->first();
       if (!$data){
           return false;
       }
       if ($data->code != $code){
           return false;
       }
       $data->status = 1;
       if ($data->save()){
           return true;
       }
           return false;
    }


}