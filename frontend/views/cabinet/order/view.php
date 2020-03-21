<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 20.02.19
 * Time: 15:37
 */

use shop\forms\Shop\Order\DeliveryForm;
use shop\helpers\OrderHelper;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order shop\entities\Shop\Order\Order */

$this->title = 'Заказ №' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'История заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $order,
        'attributes' => [
//            'id',
            'created_at:datetime',
            [
                'attribute' => 'current_status',
                'value' => OrderHelper::statusLabel($order->current_status),
                'format' => 'raw',
            ],
            'delivery_method_name',
            'deliveryData.address',
            [
                'attribute' => 'deliveryData.area',
                'value' => DeliveryForm::getArea($order->deliveryData->area),
                'format' => 'raw',

            ],
            [
                'attribute' => 'deliveryData.city',
                'value' => DeliveryForm::getCityName($order->deliveryData->city),
                'format' => 'raw',

            ],
            'deliveryData.warehouse',
            'cost',
            'note:ntext',
        ],
    ]) ?>

    <div class="table-responsive">
        <table class="table table-bordered rwd-table" style="margin-bottom: 0">
            <thead>
            <tr>
                <th class="text-left">Наименование</th>
                <th class="text-left">Модель</th>
                <th class="text-left">Количество</th>
                <th class="text-right">Цена за единицу</th>
                <th class="text-right">Итого</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->items as $item): ?>
                <tr>
                    <td class="text-left">
                        <?= Html::encode($item->product_name) ?>
                    </td>
                    <td class="text-left">
                        <?= Html::encode($item->modification_code) ?>
                        <?= Html::encode($item->modification_name) ?>
                    </td>
                    <td class="text-left">
                        <?= $item->quantity ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($item->price) ?> грн.</td>
                    <td class="text-right"><?= PriceHelper::format($item->getCost()) ?> грн.</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>