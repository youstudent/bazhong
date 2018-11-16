<?php
/**
 * Created by PhpStorm.
 * User: MyAnswer
 * Date: 2018/10/22
 * Time: 下午4:06
 */

namespace App\Http\Model;


class Coordinate
{
    public  $x = 0;//lat
    public  $y = 0; // lng
    public  $z = 0; // other

    function __construct($lat,$lng)
    {
        $this->x = $lat;
        $this->y = $lng;
    }

}