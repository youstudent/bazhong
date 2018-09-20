<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessImg extends Model
{
    //指定表名
    protected $table= 'business_img';

    //指定字段写入数据
    protected $fillable = [
        'business_id','img'
    ];
}
