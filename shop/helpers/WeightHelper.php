<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 5:39
 */

namespace shop\helpers;


class WeightHelper
{
    public static function format($weight): string
    {
        return $weight / 1000 . ' кг.';
    }
}