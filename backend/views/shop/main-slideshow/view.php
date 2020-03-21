<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.01.19
 * Time: 4:31
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $slideshow \shop\entities\Shop\MainSlideshow */

$this->title = 'Слайд';
$this->params['breadcrumbs'][] = ['label' => 'Слайды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="brand-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $slideshow->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $slideshow->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Основное</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $slideshow,
                'attributes' => [
                    'id',
                    'title',
                    'text',
                    'link',
                    'sort',
                    [
                        'attribute' => 'image',
                        'value' => "<img src='{$slideshow->getThumbFileUrl('image', 'small')}'>",
                        'format' => 'html',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
