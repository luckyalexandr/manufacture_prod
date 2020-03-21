<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.01.19
 * Time: 22:00
 */

use shop\helpers\CharacteristicHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $characteristic \shop\entities\Shop\Characteristic */

$this->title = $characteristic->name;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $characteristic->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $characteristic->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить выбранный элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $characteristic,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'attribute' => 'type',
                        'value' => CharacteristicHelper::typeName($characteristic->type),
                    ],
                    'sort',
                    'required:boolean',
                    'default',
                    [
                        'attribute' => 'variants',
                        'value' => implode(PHP_EOL, $characteristic->variants),
                        'format' => 'ntext',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
