<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/15
 * Time: 下午5:12
 */

namespace App\Http\Controllers\Api\Model;


use Illuminate\Database\Eloquent\Model;

class Ptc extends Model
{
    protected $table = 'ptc';


    protected $fillable = [
      'client_users_id','date','day','shop_id','business_name','position','img'
    ];

}