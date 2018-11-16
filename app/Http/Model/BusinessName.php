<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/25
 * Time: 下午3:09
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class BusinessName extends Model
{
    protected $table = 'business_name';

    protected $fillable =[
        'name'
    ];

}