<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/18
 * Time: 上午11:05
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class HotSearch extends Model
{
    protected $table = 'hot_search';


    protected $fillable = [
      'name'
    ];

}