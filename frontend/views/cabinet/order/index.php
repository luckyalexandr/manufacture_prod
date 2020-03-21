<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 20.02.19
 * Time: 15:36
 */

use shop\entities\Shop\Order\Order;
use shop\helpers\OrderHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'История заказов';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'id',
                        'value' => function (Order $model) {
                            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function (Order $model) {
                            return Html::a(Html::encode(Yii::$app->formatter->asDatetime($model->created_at)), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
//                    'created_at:datetime',
                    [
                        'attribute' => 'status',
                        'value' => function (Order $model) {
                            return OrderHelper::statusLabel($model->current_status);
                        },
                        'format' => 'raw',
                    ],
//                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>