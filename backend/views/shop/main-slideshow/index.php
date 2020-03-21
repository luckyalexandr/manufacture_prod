<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.01.19
 * Time: 4:12
 */

use shop\entities\Shop\MainSlideshow;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $searchModel \backend\forms\Shop\MainSlideshowSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Слайдер на главной';
$this->params['breadcrumbs'][] = $this->title; ?>
<div class="main-slideshow-index">

    <p>
        <?= Html::a('Создать слайд', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'image',
                        'value' => function (MainSlideshow $model) {
                            return Html::img($model->getThumbFileUrl('image', 'small'));
                        },
                        'format' => 'raw',
                    ],
                    'title',
                    'link',
                    'sort',
                    ['class' => ActionColumn::class],
                ]
            ]); ?>
        </div>
    </div>
</div>
