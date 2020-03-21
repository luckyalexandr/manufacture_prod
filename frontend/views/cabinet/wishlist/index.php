<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 07.02.19
 * Time: 0:14
 */

/* @var $this yii\web\View */

use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Список желаний';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-wishlist">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
//        'options' => ['class' => 'table-bordered rwd-table'],
        'tableOptions' => ['class' => 'table table-bordered rwd-table'],
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'value' => function (Product $model) {
                    return $model->mainPhoto ? Html::img($model->mainPhoto->getThumbFileUrl('file', 'admin')) : null;
                },
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 100px'],
            ],
//            'id',
            [
                'attribute' => 'name',
                'value' => function (Product $model) {
                    return Html::a(Html::encode($model->name), ['/shop/catalog/slug-product', 'slug' => $model->slug]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'price_new',
                'value' => function (Product $model) {
                    return PriceHelper::format($model->price_new) . ' грн';
                },
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{delete}',
            ],
        ],
    ]); ?>
</div>
