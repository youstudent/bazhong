<?php

namespace App\Http\Controllers\Api\V1\Controller;

use App\Http\Controllers\Api\Model\Message;
use Illuminate\Http\Request;

class RestFulController extends BaseController
{
    public function test(){
         return $this->jsonEncode(1,'测试');
    }

}
