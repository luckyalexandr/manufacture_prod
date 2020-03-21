<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.02.19
 * Time: 10:04
 */

/* @var $this yii\web\View */
/* @var $order \shop\entities\Shop\Order\Order */
/* @var $user \shop\entities\User\User */

use shop\forms\Shop\Order\DeliveryForm; ?>
<div class="checkout-user-to">
    <h1>Здравствуйте, <?= $user->username ?></h1>
    <p>Вы оформили заказ на сайте manufacture17.com.ua.</p>
    <p>В ближайшее время с Вами свяжется наш менеджер для уточнения деталей оплаты.</p>
    <div class="order-details" style="text-align: left;margin: 15px;">
        <p>Общая сумма: <?= $order->cost ?></p>
        <p>Метод доставки: <?= $order->delivery_method_name ?></p>
        <p>Адрес: <?= $order->deliveryData->address ?></p>
        <p>Отделение НП:<br>
            <?= DeliveryForm::getArea($order->deliveryData->area) ?> обл.<br>
            г. <?= DeliveryForm::getCityName($order->deliveryData->city) ?> <br>
            <?= $order->deliveryData->warehouse ?>
        </p>
        <div class="order-items" style="width: 100%; margin: 15px; border: 1px solid #999999">
            <?php foreach ($order->items as $item): ?>
                <div class="order-item" style="margin: 5px; padding: 5px; border: 1px solid #999999">
                    <p>Наименование:<?= $item->product_name ?></p>
                    <p>Артикул: <?= $item->product_code ?></p>
                    <p>Цена: <?= $item->price ?></p>
                    <p>Количество: <?= $item->quantity ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <p>
        <strong>Спасибо за покупку!</strong>
    </p>
</div>
