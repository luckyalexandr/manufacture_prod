<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.01.19
 * Time: 8:43
 */

use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use shop\helpers\ProductHelper;
use yii\helpers\Html;
use yii\grid\GridView;
//use uranum\excel\ExcelExchanger;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Shop\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Импорт товара', ['import-excel'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions' => function (Product $model) {
                    return $model->quantity <= 0 ? ['style' => 'background: #fdc'] : [];
                },
                'columns' => [
                    [
                        'value' => function (Product $model) {
                            return $model->mainPhoto ? Html::img($model->mainPhoto->getThumbFileUrl('file', 'small')) : null;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 100px'],
                    ],
                    'code',
                    [
                        'attribute' => 'name',
                        'value' => function (Product $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'category_id',
                        'filter' => $searchModel->categoriesList(),
                        'value' => 'category.name',
                    ],
                    [
                        'attribute' => 'price_new',
                        'value' => function (Product $model) {
                            return PriceHelper::format($model->price_new);
                        },
                    ],
                    'quantity',
                    [
                        'attribute' => 'status',
                        'filter' => $searchModel->statusList(),
                        'value' => function (Product $model) {
                            return ProductHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
    <?php
//    echo ExcelExchanger::widget([
//        'mainModelName' => Product::className(), // here place model class name
//    ]); ?>
</div>
