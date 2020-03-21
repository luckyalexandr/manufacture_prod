<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 02.03.19
 * Time: 17:43
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $model \shop\forms\manage\Shop\Product\ReviewEditForm */

$this->title = 'Редактировать отзыв к: ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border"></div>
        <div class="box-body">
            <?= $form->field($model, 'vote')->textInput() ?>
            <?= $form->field($model, 'text')->textarea(['rows' => 20]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
