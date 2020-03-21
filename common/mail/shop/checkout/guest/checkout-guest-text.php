<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.02.19
 * Time: 10:05
 */

/* @var $this yii\web\View */
/* @var $order \shop\entities\Shop\Order\Order */

use shop\forms\Shop\Order\DeliveryForm; ?>
<div class="checkout-guest">
    <p>Новый заказ на сайте manufacture17.com.ua.</p>
    <div class="order-details">
        <p>Email: <?= $order->customerData->email ?></p>
        <p>Телефон: <?= $order->customerData->phone ?></p>
        <p>ФИО: <?= $order->customerData->name ?></p>
        <p>Адрес: <?= $order->deliveryData->address ?></p>
        <p>Дополнительная информайия: <?= $order->note ?></p>
        <p>Общая сумма: <?= $order->cost ?></p>
        <p>Метод доставки: <?= $order->delivery_method_name ?></p>
        <p>Отделение НП:<br>
            <?= DeliveryForm::getArea($order->deliveryData->area) ?> обл.<br>
            г. <?= DeliveryForm::getCityName($order->deliveryData->city) ?> <br>
            <?= $order->deliveryData->warehouse ?>
        </p>
        <?php foreach ($order->items as $item): ?>
            <div class="order-item">
                <p>Наименование:<?= $item->product_name ?></p>
                <p>Артикул: <?= $item->product_code ?></p>
                <p>Цена: <?= $item->price ?></p>
                <p>Количество: <?= $item->quantity ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
