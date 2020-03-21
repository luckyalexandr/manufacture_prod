<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 4:50
 */

namespace shop\repositories\Shop;

use shop\entities\Shop\Order\Order;
use shop\repositories\NotFoundException;

class OrderRepository
{
    public function get($id): Order
    {
        if (!$order = Order::findOne($id)) {
            throw new NotFoundException('Заказ не найден.');
        }
        return $order;
    }

    public function save(Order $order): void
    {
        if (!$order->save()) {
            throw new \RuntimeException('Ошибка при сохранении.');
        }
    }

    public function remove(Order $order): void
    {
        if (!$order->delete()) {
            throw new \RuntimeException('Ошибка при удалени.');
        }
    }
}