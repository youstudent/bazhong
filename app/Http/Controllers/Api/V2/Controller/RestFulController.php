<?php

namespace App\Http\Controllers\Api\V2\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestFulController extends Controller
{
    public function test(){
        return '则是版本2';
    }
}
