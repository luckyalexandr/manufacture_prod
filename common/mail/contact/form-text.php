<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.02.19
 * Time: 10:05
 */

/* @var $this yii\web\View */
/* @var $order \shop\entities\Shop\Order\Order */

/* @var $this yii\web\View */
/* @var $form \shop\forms\ContactForm */ ?>
<div class="contact-form">
    <p>Новое сообщение с сайта manufacture17.com.ua.</p>
    <div class="order-details" style="text-align: left;margin: 15px;">
        <p>Емейл: <?= $form->email ?></p>
        <p>ФИО: <?= $form->name ?></p>
        <p>Сообщение: <?= $form->body ?></p>
    </div>
</div>