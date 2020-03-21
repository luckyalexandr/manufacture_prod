<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.01.19
 * Time: 15:44
 */

use shop\entities\Shop\Characteristic;
use shop\helpers\CharacteristicHelper;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $searchModel \backend\forms\Shop\CharacteristicSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Характеристики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-index">

    <p>
        <?= Html::a('Создать характеристику', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'value' => function (Characteristic $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'type',
                        'filter' => $searchModel->typesList(),
                        'value' => function (Characteristic $model) {
                            return CharacteristicHelper::typeName($model->type);
                        },
                    ],
                    [
                        'attribute' => 'required',
                        'filter' => $searchModel->requiredList(),
                        'format' => 'boolean',
                    ],
                    ['class' => \yii\grid\ActionColumn::class],
                ]
            ]); ?>
        </div>
    </div>
</div>
