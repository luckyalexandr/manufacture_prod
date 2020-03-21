<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 02.03.19
 * Time: 17:36
 */

use shop\entities\Shop\Product\Review;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $review shop\entities\Shop\Product\Review */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'product_id' => $product->id, 'id' => $review->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($review->isActive()): ?>
            <?= Html::a('Удалить', ['delete', 'product_id' => $product->id, 'id' => $review->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Одобрить', ['activate', 'product_id' => $product->id, 'id' => $review->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want to activate this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $review,
                'attributes' => [
                    'id',
                    'created_at:boolean',
                    'active:boolean',
                    'user_id',
                    [
                        'attribute' => 'text',
                        'value' => function (Review $model) {
                            return StringHelper::truncate(strip_tags($model->text), 100);
                        },
                    ],
                    'vote',
                    [
                        'attribute' => 'product_id',
                        'value' => $product->name,
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <?= Yii::$app->formatter->asNtext($review->text) ?>
        </div>
    </div>

</div>
