<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 1:52
 */

namespace shop\entities\Shop\queries;

use yii\db\ActiveQuery;

class DeliveryMethodQuery extends ActiveQuery
{
    public function availableForWeight($weight)
    {
        return $this->andWhere(['and',
            ['or', ['min_weight' => null], ['<=', 'min_weight', $weight]],
            ['or', ['max_weight' => null], ['>=', 'max_weight', $weight]],
        ]);
    }
}