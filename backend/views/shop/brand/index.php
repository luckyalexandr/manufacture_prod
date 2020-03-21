<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.01.19
 * Time: 15:55
 */

use shop\entities\Shop\Brand;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Shop\BrandSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Бренды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">
    <p>
        <?= Html::a('Создать бренд', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (Brand $brand) {
                            return Html::a(Html::encode($brand->name), ['view', 'id' => $brand->id]);
                        },
                        'format' => 'raw',
                    ],
                    'slug',
                    ['class' => \yii\grid\ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>
