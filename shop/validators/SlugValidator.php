<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 09.12.18
 * Time: 21:17
 */

namespace shop\validators;


use yii\validators\RegularExpressionValidator;

class SlugValidator extends RegularExpressionValidator
{
    public $pattern = '#^[a-z0-9_-]+$#s';
    public $message = 'Неверный формат слага. Допустимы, только символы [a-z0-9_-]';
}