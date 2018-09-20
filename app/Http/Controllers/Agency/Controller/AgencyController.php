<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/9/13
 * Time: 下午5:32
 */

namespace App\Http\Controllers\Agency\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AgencyController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}