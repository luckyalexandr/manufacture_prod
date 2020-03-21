<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.01.19
 * Time: 21:47
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \shop\forms\manage\Shop\CharacteristicForm */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="characteristic-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'type')->dropDownList($model->typesList()) ?>
            <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'required')->checkbox() ?>
            <?= $form->field($model, 'default')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'textVariants')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
