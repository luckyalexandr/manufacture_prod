<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.02.19
 * Time: 8:30
 */

namespace shop\entities\Shop\queries;

use yii\db\ActiveQuery;

class DiscountQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => true]);
    }
}