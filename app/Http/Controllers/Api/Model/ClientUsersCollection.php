<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/17
 * Time: 上午10:39
 */

namespace App\Http\Controllers\Api\Model;


class ClientUsersCollection
{
    protected $table= 'client_users_collection';


    protected $fillable = [
        'client_users_id','business_id'
    ];
}