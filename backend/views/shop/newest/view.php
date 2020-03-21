<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.01.19
 * Time: 15:43
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $newest \shop\entities\Shop\Newest */

$this->title = $newest->quantity;
$this->params['breadcrumbs'][] = ['label' => 'Новинки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newest-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $newest->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $newest->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $newest,
                'attributes' => [
                    'id',
                    'quantity',
                ],
            ]); ?>
        </div>
    </div>
</div>