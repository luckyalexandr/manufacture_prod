<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.01.19
 * Time: 4:20
 */

namespace shop\helpers;


class PriceHelper
{
    public static function format($price): string
    {
        return number_format($price, 0, '.', ' ');
    }
}