<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.12.18
 * Time: 1:49
 */

namespace shop\entities\Shop\queries;


use paulzi\nestedsets\NestedSetsQueryTrait;
use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    use NestedSetsQueryTrait;
}