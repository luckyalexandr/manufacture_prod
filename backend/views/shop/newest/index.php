<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.01.19
 * Time: 15:42
 */

use shop\entities\Shop\Tag;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $searchModel \backend\forms\Shop\NewestSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Новинки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newest-index">

    <p>
        <?= Html::a('Создать количество', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'quantity',
                    ['class' => ActionColumn::class],
                ]
            ]); ?>
        </div>
    </div>
</div>
