<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/17
 * Time: 上午10:39
 */

namespace App\Http\Controllers\Api\Model;


use Illuminate\Database\Eloquent\Model;

class ClientUsersCollection extends Model
{
    protected $table= 'client_users_collection';


    protected $fillable = [
        'client_users_id','business_id'
    ];
}