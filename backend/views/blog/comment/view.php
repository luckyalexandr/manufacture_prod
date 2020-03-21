<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 14:51
 */

use shop\entities\User\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $post shop\entities\Blog\Post\Post */
/* @var $comment shop\entities\Blog\Post\Comment */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $post->title;
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Изменить', ['update', 'post_id' => $post->id, 'id' => $comment->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($comment->isActive()): ?>
            <?= Html::a('Удалить', ['delete', 'post_id' => $post->id, 'id' => $comment->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Восстановить', ['activate', 'post_id' => $post->id, 'id' => $comment->id], [
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
                'model' => $comment,
                'attributes' => [
                    'id',
                    'created_at:datetime',
                    'active:boolean',
                    [
                        'attribute' => 'user_id',
                        'value' => User::findOne($comment->user_id)->username,
                    ],
                    'parent_id',
                    [
                        'attribute' => 'post_id',
                        'value' => $post->title,
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <?= Yii::$app->formatter->asNtext($comment->text) ?>
        </div>
    </div>

</div>
