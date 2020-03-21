<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.02.19
 * Time: 10:05
 */

/* @var $this yii\web\View */
/* @var $form \shop\forms\SamplesForm */ ?>
<div class="contact-form">
    <p>Заказ образцов с сайта manufacture17.com.ua.</p>
    <div class="samples-details" style="text-align: left;margin: 15px;">
        <p>ФИО: <?= $form->name ?></p>
        <p>Телефон: <?= $form->phone ?></p>
        <p>Email: <?= $form->email ?></p>
        <p>Адрес: <?= $form->address ?></p>
        <p>Список артиклей: <?= $form->articles ?></p>
    </div>
</div>
