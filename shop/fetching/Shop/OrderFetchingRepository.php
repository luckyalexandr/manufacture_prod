<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 20.02.19
 * Time: 15:32
 */

namespace shop\fetching\Shop;


use shop\entities\Shop\Order\Order;
use yii\data\ActiveDataProvider;

class OrderFetchingRepository
{
    public function getOwm($userId): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Order::find()
                ->andWhere(['user_id' => $userId])
                ->orderBy(['id' => SORT_DESC]),
            'sort' => false,
        ]);
    }

    public function findOwn($userId, $id): ?Order
    {
        return Order::find()->andWhere(['user_id' => $userId, 'id' => $id])->one();
    }
}