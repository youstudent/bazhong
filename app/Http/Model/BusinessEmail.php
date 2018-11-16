<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/11/15
 * Time: 下午6:01
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class BusinessEmail extends Model
{
    protected $table = 'business_email';

    protected $fillable = [
        'shop_id','email_id'
    ];


}