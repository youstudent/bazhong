<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/25
 * Time: 下午3:08
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class BusinessArea extends Model
{
    protected $table = 'business_area';

    protected $fillable =[
      'area'
    ];


}